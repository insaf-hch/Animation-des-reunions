<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SmartMeeting — Gérez vos réunions intelligemment</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --ink: #060D1A; --teal: #0A7EA4; --green: #16A34A; --lime: #34D399; }
        body { font-family: 'Inter', sans-serif; background: var(--ink); color: #fff; overflow-x: hidden; }

        /* NAV */
        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 100; padding: 0 60px; height: 68px; display: flex; align-items: center; gap: 20px; border-bottom: 1px solid rgba(255,255,255,.08); backdrop-filter: blur(12px); background: rgba(6,13,26,.75); }
        .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; border-radius: 9px; background: linear-gradient(135deg, var(--teal), var(--green)); display: flex; align-items: center; justify-content: center; }
        .brand-icon i { font-size: 15px; color: #fff; }
        .brand-name { font-size: 17px; font-weight: 700; color: #fff; }
        .brand-name span { color: var(--lime); }
        .nav-links { display: flex; gap: 4px; margin-left: 32px; }
        .nav-links a { padding: 8px 14px; border-radius: 7px; font-size: 13.5px; color: rgba(255,255,255,.55); text-decoration: none; transition: all .15s; }
        .nav-links a:hover { color: #fff; background: rgba(255,255,255,.07); }
        .nav-actions { margin-left: auto; display: flex; gap: 10px; align-items: center; }
        .btn-ghost { padding: 8px 18px; border: 1px solid rgba(255,255,255,.18); border-radius: 8px; background: transparent; color: #fff; font-family: inherit; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; transition: all .15s; }
        .btn-ghost:hover { background: rgba(255,255,255,.1); color: #fff; }
        .btn-grad { padding: 9px 20px; background: linear-gradient(135deg, var(--teal), var(--green)); border: none; border-radius: 8px; color: #fff; font-family: inherit; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none; transition: opacity .15s; box-shadow: 0 4px 16px rgba(10,126,164,.3); }
        .btn-grad:hover { opacity: .9; color: #fff; }

        /* HERO */
        .hero { padding: 160px 60px 100px; text-align: center; position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; width: 700px; height: 700px; border-radius: 50%; background: radial-gradient(circle, rgba(10,126,164,.18) 0%, transparent 70%); top: -100px; left: 50%; transform: translateX(-50%); pointer-events: none; }
        .hero-badge { display: inline-flex; align-items: center; gap: 8px; padding: 6px 16px; border-radius: 100px; border: 1px solid rgba(10,126,164,.4); background: rgba(10,126,164,.12); font-size: 12px; font-weight: 600; color: var(--lime); margin-bottom: 28px; }
        .hero h1 { font-size: 58px; font-weight: 800; line-height: 1.1; letter-spacing: -2px; margin-bottom: 22px; max-width: 760px; margin-left: auto; margin-right: auto; }
        .grad-text { background: linear-gradient(135deg, #34D399, #0A7EA4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero-sub { font-size: 17px; color: rgba(255,255,255,.6); line-height: 1.65; max-width: 520px; margin: 0 auto 40px; }
        .hero-cta { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; margin-bottom: 60px; }
        .btn-hero { padding: 14px 30px; border-radius: 10px; font-family: inherit; font-size: 15px; font-weight: 600; cursor: pointer; text-decoration: none; transition: all .15s; display: inline-flex; align-items: center; gap: 9px; }
        .btn-hero-main { background: linear-gradient(135deg, var(--teal), var(--green)); color: #fff; border: none; box-shadow: 0 8px 30px rgba(10,126,164,.35); }
        .btn-hero-main:hover { opacity: .9; transform: translateY(-1px); color: #fff; }
        .btn-hero-sec { background: rgba(255,255,255,.07); color: #fff; border: 1px solid rgba(255,255,255,.18); }
        .btn-hero-sec:hover { background: rgba(255,255,255,.12); color: #fff; }

        /* MOCKUP */
        .mockup-wrap { max-width: 880px; margin: 0 auto; border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,.1); box-shadow: 0 40px 100px rgba(0,0,0,.5); }
        .mockup-bar { background: #1a2535; padding: 12px 16px; display: flex; align-items: center; gap: 7px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; }
        .mockup-inner { background: #0F1C2E; padding: 18px; display: grid; grid-template-columns: 170px 1fr; gap: 14px; min-height: 300px; }
        .mock-sb { display: flex; flex-direction: column; gap: 5px; }
        .mock-nav { padding: 8px 10px; border-radius: 7px; font-size: 12px; font-weight: 500; color: rgba(255,255,255,.45); }
        .mock-nav.act { background: rgba(10,126,164,.25); color: #34D399; border: 1px solid rgba(10,126,164,.25); }
        .mock-main { display: flex; flex-direction: column; gap: 10px; }
        .mock-banner { border-radius: 10px; padding: 14px 16px; background: linear-gradient(135deg, #0A2540, #0A7EA4 60%, #16A34A); }
        .mock-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 7px; }
        .mock-stat { border-radius: 8px; padding: 10px; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.06); }
        .mock-val { font-size:18px; font-weight:700; }
        .mock-lbl { font-size:9px; opacity:.5; margin-top:2px; }
        .mock-line { height: 7px; border-radius: 4px; background: rgba(255,255,255,.1); margin-bottom: 5px; }

        /* STATS SECTION */
        .stats-section { padding: 60px; display: flex; justify-content: center; border-top: 1px solid rgba(255,255,255,.07); border-bottom: 1px solid rgba(255,255,255,.07); }
        .stat-item { text-align: center; padding: 0 60px; border-right: 1px solid rgba(255,255,255,.07); }
        .stat-item:last-child { border-right: none; }
        .stat-num { font-size: 42px; font-weight: 800; background: linear-gradient(135deg, #34D399, #0A7EA4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .stat-lbl { font-size: 14px; color: rgba(255,255,255,.45); margin-top: 4px; }

        /* FEATURES */
        .section { padding: 80px 60px; max-width: 1200px; margin: 0 auto; }
        .section-badge { display: inline-block; padding: 5px 14px; border-radius: 100px; border: 1px solid rgba(52,211,153,.3); background: rgba(52,211,153,.08); font-size: 12px; font-weight: 600; color: var(--lime); margin-bottom: 16px; }
        .section-h { font-size: 38px; font-weight: 800; line-height: 1.2; margin-bottom: 50px; }
        .features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; }
        .feat-card { border: 1px solid rgba(255,255,255,.07); border-radius: 14px; padding: 24px; background: rgba(255,255,255,.025); transition: all .2s; }
        .feat-card:hover { border-color: rgba(10,126,164,.4); background: rgba(10,126,164,.06); transform: translateY(-3px); }
        .feat-icon { width: 46px; height: 46px; border-radius: 12px; background: linear-gradient(135deg, rgba(10,126,164,.2), rgba(22,163,74,.15)); display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 16px; }
        .feat-title { font-size: 15px; font-weight: 700; margin-bottom: 8px; }
        .feat-desc { font-size: 13px; color: rgba(255,255,255,.5); line-height: 1.6; }

        /* FOOTER */
        footer { border-top: 1px solid rgba(255,255,255,.07); padding: 36px 60px; display: flex; align-items: center; justify-content: space-between; }
        footer p { font-size: 13px; color: rgba(255,255,255,.35); }

        @media (max-width: 768px) {
            nav { padding: 0 20px; }
            .nav-links { display: none; }
            .hero { padding: 120px 20px 60px; }
            .hero h1 { font-size: 36px; }
            .stats-section { padding: 40px 20px; flex-wrap: wrap; gap: 20px; }
            .stat-item { border-right: none; padding: 0 20px; }
            .section { padding: 60px 20px; }
            .features-grid { grid-template-columns: 1fr; }
            footer { flex-direction: column; gap: 14px; text-align: center; padding: 30px 20px; }
        }
    </style>
</head>
<body>

{{-- NAV --}}
<nav>
    <a href="{{ route('home') }}" class="brand">
        <div class="brand-icon"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="brand-name">Smart<span>Meeting</span></div>
    </a>
    <div class="nav-links">
        <a href="#features">Fonctionnalités</a>
        <a href="#stats">Statistiques</a>
    </div>
    <div class="nav-actions">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-grad"><i class="fa-solid fa-house"></i> Mon espace</a>
        @else
            <a href="{{ route('login') }}" class="btn-ghost">Connexion</a>
            <a href="{{ route('register') }}" class="btn-grad">Commencer gratuitement</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-badge"><i class="fa-solid fa-bolt"></i> Gestion de réunions intelligente</div>
    <h1>Réunions de projet,<br><span class="grad-text">gérées intelligemment</span></h1>
    <p class="hero-sub">Planifiez, animez et suivez vos réunions d'équipe avec des outils professionnels intégrés dans une seule plateforme.</p>
    <div class="hero-cta">
        <a href="{{ route('register') }}" class="btn-hero btn-hero-main"><i class="fa-solid fa-rocket"></i> Commencer gratuitement</a>
        <a href="{{ route('login') }}" class="btn-hero btn-hero-sec"><i class="fa-solid fa-play"></i> Se connecter</a>
    </div>

    {{-- APP MOCKUP --}}
    <div class="mockup-wrap">
        <div class="mockup-bar">
            <div class="dot" style="background:#FF5F57;"></div>
            <div class="dot" style="background:#FEBC2E;"></div>
            <div class="dot" style="background:#28C840;"></div>
            <div style="flex:1;text-align:center;font-size:11px;color:rgba(255,255,255,.25);">smartmeeting.app/dashboard</div>
        </div>
        <div class="mockup-inner">
            <div class="mock-sb">
                <div class="mock-nav act"><i class="fa-solid fa-house" style="margin-right:7px;"></i>Dashboard</div>
                <div class="mock-nav"><i class="fa-solid fa-calendar-days" style="margin-right:7px;"></i>Réunions</div>
                <div class="mock-nav"><i class="fa-solid fa-list-check" style="margin-right:7px;"></i>Tâches</div>
                <div class="mock-nav"><i class="fa-solid fa-chart-line" style="margin-right:7px;"></i>Statistiques</div>
                <div class="mock-nav"><i class="fa-solid fa-users" style="margin-right:7px;"></i>Participants</div>
            </div>
            <div class="mock-main">
                <div class="mock-banner">
                    <div style="font-size:13px;font-weight:700;margin-bottom:4px;">Bonjour, Ahmed 👋</div>
                    <div style="font-size:11px;opacity:.7;">2 réunions aujourd'hui · 5 tâches en attente</div>
                </div>
                <div class="mock-stats">
                    <div class="mock-stat"><div class="mock-val">12</div><div class="mock-lbl">Réunions</div></div>
                    <div class="mock-stat"><div class="mock-val">28</div><div class="mock-lbl">Tâches</div></div>
                    <div class="mock-stat"><div class="mock-val">42m</div><div class="mock-lbl">Durée moy.</div></div>
                    <div class="mock-stat"><div class="mock-val">6</div><div class="mock-lbl">Membres</div></div>
                </div>
                <div style="display:flex;flex-direction:column;gap:6px;">
                    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);border-radius:8px;padding:10px 12px;display:flex;gap:10px;align-items:center;">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(22,163,74,.2);flex-shrink:0;"></div>
                        <div style="flex:1;"><div class="mock-line" style="width:55%;"></div><div class="mock-line" style="width:35%;"></div></div>
                        <div style="font-size:9px;padding:2px 7px;border-radius:100px;background:rgba(22,163,74,.2);color:#34D399;">Aujourd'hui</div>
                    </div>
                    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);border-radius:8px;padding:10px 12px;display:flex;gap:10px;align-items:center;">
                        <div style="width:36px;height:36px;border-radius:8px;background:rgba(10,126,164,.2);flex-shrink:0;"></div>
                        <div style="flex:1;"><div class="mock-line" style="width:45%;"></div><div class="mock-line" style="width:30%;"></div></div>
                        <div style="font-size:9px;padding:2px 7px;border-radius:100px;background:rgba(10,126,164,.2);color:#7DD3FC;">À venir</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<div id="stats" class="stats-section">
    <div class="stat-item"><div class="stat-num">3x</div><div class="stat-lbl">Plus productif</div></div>
    <div class="stat-item"><div class="stat-num">-40%</div><div class="stat-lbl">Temps perdu</div></div>
    <div class="stat-item"><div class="stat-num">98%</div><div class="stat-lbl">Satisfaction</div></div>
    <div class="stat-item"><div class="stat-num">∞</div><div class="stat-lbl">Réunions gérées</div></div>
</div>

{{-- FEATURES --}}
<section id="features" class="section">
    <div class="section-badge">Fonctionnalités</div>
    <h2 class="section-h">Tout ce dont vous avez besoin,<br>en un seul endroit</h2>
    <div class="features-grid">
        @foreach([
            ['fa-calendar-days', 'Planification simplifiée',     'Créez et organisez vos réunions en quelques clics avec types, lieux et participants.'],
            ['fa-stopwatch',     'Animation en temps réel',       'Timer intégré, gestion de l\'ordre du jour et prise de notes collaboratives.'],
            ['fa-circle-check',  'Décisions & Actions',           'Enregistrez les décisions prises et assignez des actions à votre équipe.'],
            ['fa-file-lines',    'Comptes rendus PDF',            'Génération automatique et impression du compte rendu formaté.'],
            ['fa-chart-line',    'Statistiques avancées',         'Analysez vos réunions avec des graphiques clairs et des KPIs pertinents.'],
            ['fa-users',         'Gestion d\'équipe',             'Gérez vos participants et suivez leur implication sur les projets.'],
        ] as [$icon, $title, $desc])
        <div class="feat-card">
            <div class="feat-icon"><i class="fa-solid {{ $icon }}" style="color:#34D399;"></i></div>
            <div class="feat-title">{{ $title }}</div>
            <div class="feat-desc">{{ $desc }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section style="padding:80px 60px;text-align:center;background:linear-gradient(135deg,rgba(10,126,164,.1),rgba(22,163,74,.08));border-top:1px solid rgba(255,255,255,.07);border-bottom:1px solid rgba(255,255,255,.07);">
    <h2 style="font-size:36px;font-weight:800;margin-bottom:14px;">Prêt à transformer vos réunions ?</h2>
    <p style="font-size:16px;color:rgba(255,255,255,.5);margin-bottom:32px;">Rejoignez SmartMeeting et gérez vos réunions comme un pro.</p>
    <a href="{{ route('register') }}" class="btn-grad" style="display:inline-flex;align-items:center;gap:9px;padding:14px 32px;font-size:15px;border-radius:10px;">
        <i class="fa-solid fa-rocket"></i> Commencer gratuitement
    </a>
</section>

{{-- FOOTER --}}
<footer>
    <a href="{{ route('home') }}" class="brand">
        <div class="brand-icon"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="brand-name">Smart<span>Meeting</span></div>
    </a>
    <p>© {{ date('Y') }} SmartMeeting — Projet universitaire Gestion de Projets</p>
</footer>

</body>
</html>
