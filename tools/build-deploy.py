#!/usr/bin/env python3
"""
Build an upload-ready package for shared hosting (GoDaddy cPanel etc.).

    python3 tools/build-deploy.py [php-binary]

Creates deploy/ (gitignored) with:
  lankassl-site.zip   – the website, ready to extract into public_html
  database.sql        – tables + first admin account (import with phpMyAdmin)
  ADMIN-LOGIN.txt     – the admin username and generated password
"""
import os, secrets, subprocess, sys, zipfile

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUT = os.path.join(ROOT, 'deploy')
PHP = sys.argv[1] if len(sys.argv) > 1 else '/Applications/XAMPP/xamppfiles/bin/php'

INCLUDE_DIRS = ['inc', 'pages', 'admin', 'class', 'post-and-get', 'database', 'assets/v2', 'assets/img/product/pdf']
INCLUDE_FILES = ['index.php', '.htaccess', 'under-construction.php',
                 'assets/img/testimg/logo.jpg', 'assets/img/testimg/Barbed.png', 'assets/img/testimg/CHainlink 1.png',
                 'assets/img/testimg/gi.png', 'assets/img/testimg/banners/banner-1.jpg',
                 'assets/img/testimg/banners/banner-2.jpg', 'assets/img/testimg/banners/banner-3.jpg']
SKIP_NAMES = {'.DS_Store', 'debug.log', 'db-config.php'}

DB_CONFIG = """<?php
// Database credentials for this server — fill in from cPanel → MySQL Databases.
return [
	'host'     => 'localhost',
	'port'     => 3306,
	'database' => 'CHANGE_ME_database_name',
	'username' => 'CHANGE_ME_database_user',
	'password' => 'CHANGE_ME_password',
];
"""

os.makedirs(OUT, exist_ok=True)

# 1) site zip
zip_path = os.path.join(OUT, 'lankassl-site.zip')
count = 0
with zipfile.ZipFile(zip_path, 'w', zipfile.ZIP_DEFLATED) as z:
    for d in INCLUDE_DIRS:
        for base, dirs, files in os.walk(os.path.join(ROOT, d)):
            dirs[:] = [x for x in dirs if not x.startswith('.')]
            for f in files:
                if f in SKIP_NAMES:
                    continue
                full = os.path.join(base, f)
                z.write(full, os.path.relpath(full, ROOT)); count += 1
    for f in INCLUDE_FILES:
        full = os.path.join(ROOT, f)
        if f.endswith('.png') and os.path.getsize(full) > 1_000_000:
            # Oversized under-construction artwork: ship a web-sized copy
            import io
            from PIL import Image
            im = Image.open(full); im.thumbnail((1000, 1000))
            buf = io.BytesIO(); im.save(buf, 'PNG', optimize=True)
            z.writestr(f, buf.getvalue())
        else:
            z.write(full, f)
        count += 1
    z.writestr('inc/db-config.php', DB_CONFIG); count += 1

# 2) database.sql = schema + first admin
password = secrets.token_urlsafe(12)
hashed = subprocess.run([PHP, '-r', 'echo password_hash($argv[1], PASSWORD_DEFAULT);', password],
                        check=True, capture_output=True, text=True).stdout
schema = open(os.path.join(ROOT, 'database/schema.sql')).read()
with open(os.path.join(OUT, 'database.sql'), 'w') as f:
    f.write('SET NAMES utf8mb4;\n\n' + schema)
    f.write("\n-- First admin account (change the password after first login by re-running tools/create-admin.php locally if needed)\n")
    f.write("INSERT INTO admins (username, name, password_hash) VALUES ('admin', 'Lanka SSL Admin', '%s')\n"
            "  ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash);\n" % hashed)

with open(os.path.join(OUT, 'ADMIN-LOGIN.txt'), 'w') as f:
    f.write('Admin panel: https://<your-domain>/admin/\nUsername: admin\nPassword: %s\n' % password)

size = os.path.getsize(zip_path) / 1e6
print(f'deploy/lankassl-site.zip  {count} files, {size:.1f} MB')
print('deploy/database.sql       schema + admin account')
print('deploy/ADMIN-LOGIN.txt    admin password (keep private)')
