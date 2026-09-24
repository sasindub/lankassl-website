#!/usr/bin/env python3
"""
Export the PHP site to static HTML for demo hosting (e.g. Vercel).

Usage (from the project root):
    python3 tools/export-static.py [php-binary]

Starts `php -S` with LSSL_ROOT='' (root-relative URLs) and LSSL_DEMO=1
(forms show a demo notice), renders every route into dist/, copies only the
assets the pages reference, and writes dist/vercel.json.
"""
import json, os, re, shutil, subprocess, sys, time, urllib.request, urllib.error

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
DIST = os.path.join(ROOT, 'dist')
PHP = sys.argv[1] if len(sys.argv) > 1 else '/Applications/XAMPP/xamppfiles/bin/php'
PORT = 8199

PRODUCTS = subprocess.run(
    [PHP, '-r', "require $argv[1]; echo implode(PHP_EOL, array_keys($PRODUCTS));", os.path.join(ROOT, 'inc/data.php')],
    check=True, capture_output=True, text=True).stdout.split()
ROUTES = ['home', 'about-company', 'board-of-directors', 'management-team', 'business-excellence',
          'products', 'product-specification', 'product-brochures', 'awards', 'certifications',
          'press-release', 'gallery', 'careers', 'contact'] + ['products/' + p for p in PRODUCTS]
REDIRECTS = {
    'intro': 'home', 'barded-wire': 'products/barbed-wire', 'pvc-coated-iron-wire': 'products/pvc-coated-gi-wire',
    'hot-dipped-gi-wire': 'products/hot-dipped-gi-wire', 'nail-wire': 'products/nail-wire',
    'end-user-products': 'products', 'news-event': 'gallery',
}

ROUTER = os.path.join(ROOT, 'tools', '.export-router.php')
open(ROUTER, 'w').write("""<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path !== '/' && is_file($_SERVER['DOCUMENT_ROOT'] . $path)) return false;
$_GET['url'] = ltrim($path, '/');
$_SERVER['SCRIPT_NAME'] = '/index.php';
chdir($_SERVER['DOCUMENT_ROOT']);
require $_SERVER['DOCUMENT_ROOT'] . '/index.php';
""")

env = dict(os.environ, LSSL_ROOT='', LSSL_DEMO='1')
server = subprocess.Popen([PHP, '-S', f'127.0.0.1:{PORT}', '-t', ROOT, ROUTER], env=env,
                          stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL)
try:
    time.sleep(1.2)
    # Clear previous output but keep dist/.vercel (the Vercel project link)
    os.makedirs(DIST, exist_ok=True)
    for name in os.listdir(DIST):
        if name == '.vercel':
            continue
        path = os.path.join(DIST, name)
        shutil.rmtree(path) if os.path.isdir(path) else os.remove(path)
    assets = set()

    def fetch(route):
        try:
            with urllib.request.urlopen(f'http://127.0.0.1:{PORT}/{route}') as r:
                return r.read().decode('utf-8')
        except urllib.error.HTTPError as e:
            return e.read().decode('utf-8')

    for route in ROUTES + ['__404__']:
        html = fetch(route)
        if re.search(r'<b>(Warning|Fatal error|Notice|Deprecated)</b>', html):
            sys.exit(f'PHP error while rendering /{route}')
        assets.update(re.findall(r'''["'(](/assets/[^"'()\s?#]+)''', html))
        out = os.path.join(DIST, '404.html' if route == '__404__' else route + '.html')
        os.makedirs(os.path.dirname(out), exist_ok=True)
        open(out, 'w').write(html)
    shutil.copy(os.path.join(DIST, 'home.html'), os.path.join(DIST, 'index.html'))

    # CSS/JS may reference further assets
    for a in list(assets):
        if a.endswith(('.css', '.js')):
            src = open(os.path.join(ROOT, a.lstrip('/'))).read()
            for ref in re.findall(r'url\(["\']?([^"\')]+)', src):
                if not ref.startswith(('data:', 'http', '#')):
                    assets.add(os.path.normpath(os.path.join(os.path.dirname(a), ref)))

    missing = []
    for a in sorted(assets):
        src = os.path.join(ROOT, a.lstrip('/'))
        if not os.path.isfile(src):
            missing.append(a); continue
        dst = os.path.join(DIST, a.lstrip('/'))
        os.makedirs(os.path.dirname(dst), exist_ok=True)
        shutil.copy2(src, dst)
    if missing:
        sys.exit('Missing assets: ' + ', '.join(missing))

    config = {
        'cleanUrls': True,
        'trailingSlash': False,
        'redirects': [{'source': '/' + k, 'destination': '/' + v, 'permanent': True} for k, v in REDIRECTS.items()]
                     + [{'source': '/detailed-:slug', 'destination': '/gallery', 'permanent': True}],
        'headers': [{'source': '/assets/(.*)', 'headers': [{'key': 'Cache-Control', 'value': 'public, max-age=604800'}]}],
    }
    json.dump(config, open(os.path.join(DIST, 'vercel.json'), 'w'), indent=2)

    size = sum(os.path.getsize(os.path.join(d, f)) for d, _, fs in os.walk(DIST) for f in fs)
    print(f'Exported {len(ROUTES)} pages + {len(assets)} assets to dist/ ({size / 1e6:.1f} MB)')
finally:
    server.terminate()
    os.remove(ROUTER)
