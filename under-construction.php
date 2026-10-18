<?php
// Under Construction / Maintenance page for LANKA SPECIAL STEELS (LAXAPANA)
// Served by index.php. Uses the ROOT constant for asset URLs.
// Derive the web base path from this script's own location so assets load
// correctly whether the site runs at the domain root or in a subfolder,
// and on both local and live environments. (Avoids the live-domain ROOT.)
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($base === '.' || $base === '/') {
    $base = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, follow">
    <title>We'll Be Right Back - LAXAPANA | Lanka Special Steels Limited</title>
    <meta name="description" content="Our website is currently under construction. LAXAPANA by Lanka Special Steels Limited - Sri Lanka's trusted manufacturer of Barbed Wire, Chain Link &amp; GI Wire.">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?= $base ?>/assets/img/testimg/logo.jpg">
    <link rel="apple-touch-icon" href="<?= $base ?>/assets/img/testimg/logo.jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --gold: #FFC400;
            --gold-light: #FFE066;
            --gold-deep: #FF9E00;
            --amber: #FFB300;
            --ink: #0d0d0d;
            --ink-soft: #1a1a1a;
            --ink-card: #161616;
            --white: #ffffff;
            --radius: 18px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--ink);
            color: var(--white);
            overflow-x: hidden;
            line-height: 1.6;
        }

        a { text-decoration: none; color: inherit; }

        /* ====== ANIMATED BACKGROUND ====== */
        .bg-stage {
            position: fixed;
            inset: 0;
            z-index: -2;
            background:
                radial-gradient(1200px 600px at 70% -10%, rgba(255,196,0,0.28), transparent 60%),
                radial-gradient(900px 500px at 0% 100%, rgba(255,158,0,0.20), transparent 55%),
                linear-gradient(160deg, #0c0c0c 0%, #141008 45%, #0c0c0c 100%);
        }
        .bg-stage::before {
            content: "";
            position: absolute;
            inset: -20%;
            background-image: url('<?= $base ?>/assets/img/testimg/bg1.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.06;
            mix-blend-mode: screen;
            animation: drift 28s ease-in-out infinite alternate;
        }
        @keyframes drift {
            0%   { transform: scale(1.05) translate(0, 0); }
            100% { transform: scale(1.18) translate(-3%, -2%); }
        }

        /* floating glow blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.5;
            z-index: -1;
            pointer-events: none;
        }
        .blob.b1 { width: 420px; height: 420px; background: var(--gold); top: -120px; right: -80px; animation: float1 14s ease-in-out infinite; }
        .blob.b2 { width: 320px; height: 320px; background: var(--gold-deep); bottom: -100px; left: -60px; animation: float2 18s ease-in-out infinite; }
        @keyframes float1 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(40px)} }
        @keyframes float2 { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-50px)} }

        /* ====== TOP BAR ====== */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px clamp(18px, 5vw, 64px);
            position: relative;
            z-index: 5;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            animation: fadeDown 0.9s ease both;
        }
        .brand img {
            height: 64px;
            width: auto;
            background: #000;
            padding: 8px 12px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border: 1px solid rgba(255,196,0,0.25);
        }
        .brand .brand-txt small { display:block; color: var(--gold); font-weight:600; letter-spacing:2px; font-size:11px; text-transform:uppercase; }
        .brand .brand-txt span { font-weight:700; font-size:15px; color:#fff; }

        .topbar .live-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,196,0,0.12);
            border: 1px solid rgba(255,196,0,0.35);
            color: var(--gold-light);
            padding: 8px 16px; border-radius: 999px;
            font-size: 12px; font-weight: 600; letter-spacing: 1px;
            animation: fadeDown 0.9s 0.1s ease both;
        }
        .live-pill .dot { width:8px; height:8px; border-radius:50%; background: var(--gold); box-shadow:0 0 0 0 rgba(255,196,0,0.6); animation: pulse 1.8s infinite; }

        .topbar-right { display:flex; flex-direction:column; align-items:flex-end; gap:10px; animation: fadeDown 0.9s 0.1s ease both; }
        .topbar-contact { display:flex; flex-wrap:wrap; justify-content:flex-end; gap:10px; }
        .topbar-contact a {
            display:inline-flex; align-items:center; gap:8px;
            font-size:13px; font-weight:500; color:#ececec;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,196,0,0.18);
            padding: 7px 14px; border-radius: 999px;
            transition: color .25s, border-color .25s, background .25s, transform .25s;
        }
        .topbar-contact a i {
            color:#000; background: linear-gradient(135deg, var(--gold), var(--gold-deep));
            width:22px; height:22px; border-radius:50%;
            display:inline-flex; align-items:center; justify-content:center; font-size:11px; flex-shrink:0;
        }
        .topbar-contact a:hover { color: var(--gold-light); border-color: var(--gold); transform: translateY(-2px); }
        .topbar-contact a.wa i { background: linear-gradient(135deg, #25D366, #128C7E); color:#fff; }
        .topbar-contact a.wa { border-color: rgba(37,211,102,0.35); }
        .topbar-contact a.wa:hover { color:#4ee585; border-color:#25D366; }

        /* ====== HERO ====== */
        .hero {
            text-align: center;
            padding: clamp(30px, 6vh, 70px) clamp(18px, 5vw, 64px) 40px;
            position: relative;
            z-index: 2;
        }
        .gear-wrap { position: relative; display:inline-block; margin-bottom: 26px; animation: pop 0.8s 0.1s cubic-bezier(.2,.8,.2,1) both; }
        .gear {
            font-size: clamp(54px, 9vw, 96px);
            color: var(--gold);
            filter: drop-shadow(0 8px 24px rgba(255,196,0,0.45));
        }
        .gear.spin { animation: spin 9s linear infinite; }
        .gear.spin.rev { animation: spinRev 7s linear infinite; font-size: clamp(34px,6vw,60px); position:absolute; right:-26px; bottom:-10px; color: var(--gold-deep); }

        .hero h1 {
            font-size: clamp(34px, 7vw, 78px);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -1px;
            margin-bottom: 18px;
            animation: fadeUp 0.9s 0.2s ease both;
        }
        .hero h1 .grad {
            background: linear-gradient(100deg, var(--gold-light), var(--gold), var(--gold-deep));
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero p.lead {
            max-width: 640px; margin: 0 auto 14px;
            font-size: clamp(15px, 2.2vw, 19px);
            color: #d7d7d7; font-weight: 300;
            animation: fadeUp 0.9s 0.35s ease both;
        }
        .hero p.sub {
            color: var(--gold-light); font-weight: 500; letter-spacing: 0.5px;
            animation: fadeUp 0.9s 0.45s ease both;
        }

        /* progress bar */
        .progress {
            max-width: 460px; margin: 34px auto 6px;
            height: 12px; border-radius: 999px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,196,0,0.2);
            overflow: hidden;
            animation: fadeUp 0.9s 0.55s ease both;
        }
        .progress > i {
            display:block; height:100%; width: 72%;
            background: linear-gradient(90deg, var(--gold-deep), var(--gold), var(--gold-light));
            border-radius: 999px;
            background-size: 200% 100%;
            animation: load 1.6s ease forwards, shimmer 2.2s linear infinite 1.6s;
        }
        .progress-label { font-size:12px; color:#aaa; letter-spacing:2px; animation: fadeUp 0.9s 0.6s ease both; }

        /* ====== PRODUCTS ====== */
        .section-title {
            text-align:center; margin: clamp(40px,7vh,80px) 0 8px;
        }
        .section-title small { color: var(--gold); letter-spacing:4px; font-size:12px; font-weight:600; text-transform:uppercase; }
        .section-title h2 { font-size: clamp(24px,4vw,40px); font-weight:800; margin-top:6px; }
        .section-title h2 .grad { color: var(--gold); }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 26px;
            max-width: 1100px;
            margin: 36px auto 0;
            padding: 0 clamp(18px, 5vw, 40px);
        }
        .pcard {
            background: linear-gradient(180deg, rgba(255,196,0,0.06), rgba(0,0,0,0.4));
            border: 1px solid rgba(255,196,0,0.18);
            border-radius: var(--radius);
            padding: 26px 22px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform .4s cubic-bezier(.2,.8,.2,1), box-shadow .4s, border-color .4s;
        }
        .pcard::after {
            content:""; position:absolute; inset:0;
            background: radial-gradient(300px 120px at 50% 0%, rgba(255,196,0,0.18), transparent 70%);
            opacity:0; transition: opacity .4s;
        }
        .pcard:hover { transform: translateY(-12px); border-color: var(--gold); box-shadow: 0 24px 50px rgba(0,0,0,0.55); }
        .pcard:hover::after { opacity:1; }
        .pcard .img-hold {
            height: 200px; display:flex; align-items:center; justify-content:center;
            margin-bottom: 16px;
        }
        .pcard img { max-height: 200px; max-width: 100%; object-fit: contain; filter: drop-shadow(0 14px 22px rgba(0,0,0,0.5)); animation: bob 5s ease-in-out infinite; }
        .pcard:nth-child(2) img { animation-delay: .6s; }
        .pcard:nth-child(3) img { animation-delay: 1.2s; }
        .pcard h3 { font-size:18px; font-weight:700; color:#fff; }
        .pcard span.tag { display:inline-block; margin-top:8px; font-size:12px; color: var(--gold-light); border:1px solid rgba(255,196,0,0.3); padding:4px 12px; border-radius:999px; letter-spacing:1px; }

        /* ====== BANNERS (static) ====== */
        .banners {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 26px;
            max-width: 1200px;
            margin: 36px auto 0;
            padding: 0 clamp(18px, 5vw, 40px);
        }
        .banners figure {
            border-radius: 16px;
            overflow: hidden;
            border: 2px solid rgba(255,196,0,0.3);
            box-shadow: 0 18px 45px rgba(0,0,0,0.55);
            transition: transform .4s cubic-bezier(.2,.8,.2,1), box-shadow .4s, border-color .4s;
        }
        .banners figure:hover { transform: translateY(-10px); border-color: var(--gold); box-shadow: 0 28px 60px rgba(0,0,0,0.6); }
        .banners img { display:block; width: 100%; height: auto; }

        /* ====== CONTACT ====== */
        .contact {
            max-width: 1100px; margin: clamp(40px,7vh,80px) auto 0;
            padding: 0 clamp(18px, 5vw, 40px);
        }
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 18px;
            margin-top: 32px;
        }
        .ccard {
            background: var(--ink-card);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: var(--radius);
            padding: 26px 22px;
            transition: transform .35s, border-color .35s;
        }
        .ccard:hover { transform: translateY(-6px); border-color: rgba(255,196,0,0.4); }
        .ccard .ico {
            width: 52px; height: 52px; border-radius: 14px;
            display:flex; align-items:center; justify-content:center;
            font-size: 22px; margin-bottom: 16px;
            background: linear-gradient(135deg, var(--gold), var(--gold-deep));
            color:#000;
        }
        .ccard h4 { font-size:15px; letter-spacing:1px; text-transform:uppercase; color: var(--gold); margin-bottom:10px; }
        .ccard p, .ccard a { display:block; font-size:14px; color:#d4d4d4; font-weight:300; margin-bottom:4px; }
        .ccard a:hover { color: var(--gold-light); }

        /* Floating WhatsApp widget */
        .wa-widget { position: fixed; right: 22px; bottom: 22px; z-index: 60; display:flex; flex-direction:column; align-items:flex-end; gap:14px; }
        .wa-fab {
            width: 62px; height: 62px; border-radius: 50%;
            background: linear-gradient(135deg, #25D366, #128C7E); color:#fff;
            display:flex; align-items:center; justify-content:center;
            font-size: 30px; box-shadow: 0 10px 30px rgba(37,211,102,0.5);
            border:none; cursor:pointer; position:relative;
            animation: bob 3s ease-in-out infinite;
        }
        .wa-fab::before {
            content:""; position:absolute; inset:0; border-radius:50%;
            background: #25D366; z-index:-1;
            animation: ring 2s infinite;
        }
        .wa-fab:hover { transform: scale(1.08); }
        .wa-fab .fa-xmark { display:none; }
        .wa-widget.open .wa-fab .fa-whatsapp { display:none; }
        .wa-widget.open .wa-fab .fa-xmark { display:block; }
        .wa-widget.open .wa-fab { animation: none; }

        .wa-panel {
            width: 280px; max-width: calc(100vw - 44px);
            background: #0f1512;
            border: 1px solid rgba(37,211,102,0.35);
            border-radius: 16px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.6);
            overflow: hidden;
            transform-origin: bottom right;
            opacity:0; transform: translateY(12px) scale(.92); pointer-events:none;
            transition: opacity .25s ease, transform .25s cubic-bezier(.2,.8,.2,1);
        }
        .wa-widget.open .wa-panel { opacity:1; transform: translateY(0) scale(1); pointer-events:auto; }
        .wa-panel .wa-head {
            background: linear-gradient(135deg, #128C7E, #25D366); color:#fff;
            padding: 16px 18px; display:flex; align-items:center; gap:12px;
        }
        .wa-panel .wa-head i { font-size:26px; }
        .wa-panel .wa-head b { display:block; font-size:15px; font-weight:700; }
        .wa-panel .wa-head small { font-size:11.5px; opacity:.9; font-weight:300; }
        .wa-panel .wa-body { padding: 10px; }
        .wa-panel .wa-row {
            display:flex; align-items:center; gap:12px;
            padding: 10px 12px; border-radius: 11px;
            transition: background .2s, transform .2s;
        }
        .wa-panel .wa-row:hover { background: rgba(37,211,102,0.12); transform: translateX(3px); }
        .wa-panel .wa-row .av {
            width:38px; height:38px; border-radius:50%; flex-shrink:0;
            background: linear-gradient(135deg, #25D366, #128C7E); color:#fff;
            display:flex; align-items:center; justify-content:center; font-size:16px;
        }
        .wa-panel .wa-row .meta { line-height:1.25; }
        .wa-panel .wa-row .meta b { display:block; font-size:14px; color:#fff; font-weight:600; }
        .wa-panel .wa-row .meta span { font-size:13px; color:#9fe7b8; }
        .wa-panel .wa-row .go { margin-left:auto; color:#25D366; font-size:15px; }

        /* ====== FOOTER ====== */
        footer {
            margin-top: clamp(50px,8vh,90px);
            background: linear-gradient(180deg, transparent, rgba(0,0,0,0.6));
            border-top: 1px solid rgba(255,196,0,0.18);
            padding: 48px clamp(18px,5vw,64px) 26px;
        }
        .footer-grid {
            max-width: 1100px; margin: 0 auto;
            display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 34px;
        }
        .footer-grid img.flogo { height:70px; background:#000; padding:10px 14px; border-radius:12px; border:1px solid rgba(255,196,0,0.25); margin-bottom:14px; }
        .footer-grid p { color:#bdbdbd; font-size:14px; font-weight:300; max-width:320px; }
        .footer-grid h5 { color: var(--gold); font-size:14px; letter-spacing:2px; text-transform:uppercase; margin-bottom:16px; }
        .footer-grid ul { list-style:none; }
        .footer-grid ul li { font-size:14px; color:#cfcfcf; font-weight:300; margin-bottom:10px; display:flex; gap:10px; align-items:flex-start; }
        .footer-grid ul li i { color: var(--gold); margin-top:4px; }
        .socials { display:flex; gap:12px; margin-top:18px; }
        .socials a {
            width:42px; height:42px; border-radius:12px;
            display:flex; align-items:center; justify-content:center;
            background: rgba(255,255,255,0.06); border:1px solid rgba(255,196,0,0.2);
            color: var(--gold); font-size:18px; transition: all .3s;
        }
        .socials a:hover { background: var(--gold); color:#000; transform: translateY(-4px); }
        .copyright {
            max-width:1100px; margin: 34px auto 0; padding-top:22px;
            border-top:1px solid rgba(255,255,255,0.08);
            display:flex; justify-content:space-between; flex-wrap:wrap; gap:10px;
            font-size:13px; color:#9a9a9a;
        }
        .copyright a { color: var(--gold-light); }

        /* ====== KEYFRAMES ====== */
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes spinRev { to { transform: rotate(-360deg); } }
        @keyframes pulse { 0%{box-shadow:0 0 0 0 rgba(255,196,0,0.6)} 70%{box-shadow:0 0 0 10px rgba(255,196,0,0)} 100%{box-shadow:0 0 0 0 rgba(255,196,0,0)} }
        @keyframes ring { 0%{box-shadow:0 0 0 0 rgba(255,196,0,0.5)} 70%{box-shadow:0 0 0 18px rgba(255,196,0,0)} 100%{box-shadow:0 0 0 0 rgba(255,196,0,0)} }
        @keyframes bob { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        @keyframes load { from { width:0; } to { width:72%; } }
        @keyframes shimmer { to { background-position: -200% 0; } }
        @keyframes scroll { from { transform: translateX(0);} to { transform: translateX(-50%);} }
        @keyframes fadeUp { from{opacity:0; transform:translateY(28px);} to{opacity:1; transform:translateY(0);} }
        @keyframes fadeDown { from{opacity:0; transform:translateY(-20px);} to{opacity:1; transform:translateY(0);} }
        @keyframes pop { from{opacity:0; transform:scale(.6);} to{opacity:1; transform:scale(1);} }

        @media (max-width: 980px) {
            .banners { grid-template-columns: 1fr; max-width: 560px; }
        }
        @media (max-width: 760px) {
            .footer-grid { grid-template-columns: 1fr; }
            .brand .brand-txt { display:none; }
            .topbar { flex-wrap: wrap; gap: 14px; justify-content:center; }
            .topbar-right { align-items:center; }
            .topbar-contact { justify-content:center; }
            .topbar-right .live-pill { display:none; }
        }
        @media (prefers-reduced-motion: reduce) {
            * { animation-duration: 0.001s !important; animation-iteration-count: 1 !important; }
        }
    </style>
</head>
<body>
    <div class="bg-stage"></div>
    <span class="blob b1"></span>
    <span class="blob b2"></span>

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="brand">
            <img src="<?= $base ?>/assets/img/testimg/logo.jpg" alt="LAXAPANA Logo">
            <div class="brand-txt">
                <small>Lanka Special Steels</small>
                <span>LAXAPANA</span>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-contact">
                <a href="tel:+94117715300"><i class="fa-solid fa-phone"></i><span>+94 11 771 5300</span></a>
                <a href="mailto:sales@lankassl.com"><i class="fa-solid fa-envelope"></i><span>sales@lankassl.com</span></a>
                <a href="https://wa.me/94763866834" target="_blank" rel="noopener" class="wa"><i class="fa-brands fa-whatsapp"></i><span>076 386 6834</span></a>
            </div>
            <div class="live-pill"><span class="dot"></span> SITE UPGRADE IN PROGRESS</div>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="gear-wrap">
            <i class="fa-solid fa-gear gear spin"></i>
            <i class="fa-solid fa-gear gear spin rev"></i>
        </div>
        <h1>We're Building Something <span class="grad">Stronger</span></h1>
        <p class="lead">
            Our website is currently <strong>under construction</strong>. We're upgrading our
            online experience to serve you better. Sri Lanka's trusted name in
            Barbed Wire, Chain Link &amp; GI Wire will be back online shortly.
        </p>
        <p class="sub">පරම්පරා ගණනාවක විශ්වාසය - ලක්ෂපාන &nbsp;|&nbsp; Trusted for Generations</p>

        <div class="progress"><i></i></div>
        <div class="progress-label">UPGRADING - 72% COMPLETE</div>
    </section>

    <!-- PRODUCTS -->
    <div class="section-title">
        <small>While we work</small>
        <h2>Our <span class="grad">Premium</span> Products</h2>
    </div>
    <section class="products">
        <div class="pcard">
            <div class="img-hold"><img src="<?= $base ?>/assets/img/testimg/Barbed.png" alt="LAXAPANA Barbed Wire"></div>
            <h3>Barbed Wire</h3>
            <span class="tag">Hot Dipped Galvanized</span>
        </div>
        <div class="pcard">
            <div class="img-hold"><img src="<?= $base ?>/assets/img/testimg/CHainlink 1.png" alt="LAXAPANA Chain Link Fencing"></div>
            <h3>Chain Link Fencing</h3>
            <span class="tag">GI &amp; PVC Coated</span>
        </div>
        <div class="pcard">
            <div class="img-hold"><img src="<?= $base ?>/assets/img/testimg/gi.png" alt="LAXAPANA GI Wire"></div>
            <h3>GI Wire</h3>
            <span class="tag">Premium Quality</span>
        </div>
    </section>

    <!-- BANNERS (static) -->
    <div class="banners">
        <figure><img src="<?= $base ?>/assets/img/testimg/banners/banner-1.jpg" alt="LAXAPANA Barbed Wire Banner"></figure>
        <figure><img src="<?= $base ?>/assets/img/testimg/banners/banner-2.jpg" alt="LAXAPANA Barbed Wire Banner"></figure>
        <figure><img src="<?= $base ?>/assets/img/testimg/banners/banner-3.jpg" alt="LAXAPANA Chain Link Banner"></figure>
    </div>

    <!-- CONTACT -->
    <section class="contact">
        <div class="section-title" style="margin-top:clamp(40px,7vh,80px);">
            <small>Need us now?</small>
            <h2>Get In <span class="grad">Touch</span></h2>
        </div>

        <div class="contact-grid">
            <!-- Address -->
            <div class="ccard">
                <div class="ico"><i class="fa-solid fa-location-dot"></i></div>
                <h4>Address</h4>
                <p><strong>Registered Office:</strong> No. 98, Sri Sangaraja Mawatha, Colombo 10<br><strong>Corporate Office &amp; Factory:</strong> No. 5, 6, 7 LINDEL, Pattiwila Road, Sapugaskanda, Makola</p>
            </div>

            <!-- Phone -->
            <div class="ccard">
                <div class="ico"><i class="fa-solid fa-phone"></i></div>
                <h4>Phone</h4>
                <a href="tel:+94117715300">+94 11 771 5300</a>
            </div>

            <!-- Email & Website -->
            <div class="ccard">
                <div class="ico"><i class="fa-solid fa-envelope"></i></div>
                <h4>Email &amp; Website</h4>
                <a href="mailto:sales@lankassl.com">sales@lankassl.com</a>
                <a href="https://www.lankassl.com" target="_blank" rel="noopener">www.lankassl.com</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div>
                <img class="flogo" src="<?= $base ?>/assets/img/testimg/logo.jpg" alt="LAXAPANA Logo">
                <p>LANKA SPECIAL STEELS LIMITED - the undisputed leader in the steel market in Sri Lanka, manufacturers of the trusted <strong>LAXAPANA</strong> brand.</p>
                <div class="socials">
                    <a href="https://www.facebook.com/LaxapanaSteel" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/laxapanasteel/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@laxapanasteel" target="_blank" rel="noopener" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://x.com/LankaSSLltd" target="_blank" rel="noopener" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/@laxapanasteel" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/company/6755348/" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>

            <div>
                <h5>Contact</h5>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> No. 98, Sri Sangaraja Mawatha, Colombo 10, Sri Lanka</li>
                    <li><i class="fa-solid fa-industry"></i> No. 5, 6, 7 LINDEL, Pattiwila Road, Sapugaskanda, Makola, Sri Lanka</li>
                    <li><i class="fa-solid fa-phone"></i> +94 11 771 5300</li>
                </ul>
            </div>

            <div>
                <h5>Reach Us</h5>
                <ul>
                    <li><i class="fa-solid fa-envelope"></i> sales@lankassl.com</li>
                    <li><i class="fa-solid fa-globe"></i> www.lankassl.com</li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            <span>&copy; <?= date('Y') ?> <a href="https://www.lankassl.com">Lanka Special Steels Limited</a>. All rights reserved.</span>
            <span>Website under construction - we'll be back soon.</span>
        </div>
    </footer>

    <!-- Floating WhatsApp widget -->
    <div class="wa-widget" id="waWidget">
        <div class="wa-panel" role="dialog" aria-label="Chat with us on WhatsApp">
            <div class="wa-head">
                <i class="fa-brands fa-whatsapp"></i>
                <div>
                    <b>WhatsApp &amp; Sales</b>
                    <small>Select a number to start a chat</small>
                </div>
            </div>
            <div class="wa-body">
                <a class="wa-row" href="https://wa.me/94763866834" target="_blank" rel="noopener">
                    <span class="av"><i class="fa-brands fa-whatsapp"></i></span>
                    <span class="meta"><b>Saman</b><span>076 386 6834</span></span>
                    <i class="fa-solid fa-arrow-right go"></i>
                </a>
                <a class="wa-row" href="https://wa.me/94763866097" target="_blank" rel="noopener">
                    <span class="av"><i class="fa-brands fa-whatsapp"></i></span>
                    <span class="meta"><b>Charith</b><span>076 386 6097</span></span>
                    <i class="fa-solid fa-arrow-right go"></i>
                </a>
                <a class="wa-row" href="https://wa.me/94773215793" target="_blank" rel="noopener">
                    <span class="av"><i class="fa-brands fa-whatsapp"></i></span>
                    <span class="meta"><b>Kuganeswaran</b><span>077 321 5793</span></span>
                    <i class="fa-solid fa-arrow-right go"></i>
                </a>
                <a class="wa-row" href="https://wa.me/94768478199" target="_blank" rel="noopener">
                    <span class="av"><i class="fa-brands fa-whatsapp"></i></span>
                    <span class="meta"><b>Lakmal</b><span>076 847 8199</span></span>
                    <i class="fa-solid fa-arrow-right go"></i>
                </a>
            </div>
        </div>
        <button class="wa-fab" id="waFab" aria-label="Chat on WhatsApp" aria-expanded="false">
            <i class="fa-brands fa-whatsapp"></i>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <script>
        (function () {
            var widget = document.getElementById('waWidget');
            var fab = document.getElementById('waFab');
            function close() { widget.classList.remove('open'); fab.setAttribute('aria-expanded', 'false'); }
            fab.addEventListener('click', function (e) {
                e.stopPropagation();
                var open = widget.classList.toggle('open');
                fab.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
            // close when clicking outside or pressing Escape
            document.addEventListener('click', function (e) {
                if (!widget.contains(e.target)) close();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') close();
            });
        })();
    </script>
</body>
</html>
