<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>SmartMeeting — @yield('title','Dashboard')</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
:root{
  --primary:#0A7EA4;--primary-h:#086B8C;--primary-light:#E0F4FA;--primary-glow:rgba(10,126,164,.15);
  --accent:#16A34A;--accent-light:#DCFCE7;
  --warn:#D97706;--warn-light:#FEF3C7;
  --danger:#DC2626;--danger-light:#FEE2E2;
  --sidebar-bg:#1E1F26;--sidebar-w:68px;--sidebar-full:240px;--topbar-h:52px;
  --bg:#F0F2F5;--surface:#FFFFFF;--surface-2:#F8FAFC;--surface-3:#F1F5F9;
  --border:#E2E8F0;--border-2:#CBD5E1;
  --text:#111827;--text-sub:#4B5563;--text-hint:#9CA3AF;
  --shadow-sm:0 1px 3px rgba(0,0,0,.08);--shadow-md:0 4px 16px rgba(0,0,0,.08);
  --r-sm:6px;--r-md:10px;--r-lg:14px;--r-xl:18px;
  font-family:'Outfit',sans-serif;
}
[data-theme="dark"]{
  --primary-light:rgba(10,126,164,.2);--accent-light:rgba(22,163,74,.2);
  --warn-light:rgba(217,119,6,.2);--danger-light:rgba(220,38,38,.2);
  --sidebar-bg:#111318;
  --bg:#1A1D24;--surface:#21252E;--surface-2:#191C23;--surface-3:#1C2029;
  --border:rgba(255,255,255,.07);--border-2:rgba(255,255,255,.12);
  --text:#F1F5F9;--text-sub:#94A3B8;--text-hint:#475569;
  --shadow-sm:0 1px 3px rgba(0,0,0,.3);--shadow-md:0 4px 16px rgba(0,0,0,.3);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{height:100%;}
body{background:var(--bg);color:var(--text);display:flex;min-height:100vh;transition:background .3s,color .3s;overflow-x:hidden;}
a{text-decoration:none;color:inherit;}
button{font-family:inherit;}

/* SIDEBAR */
.sidebar{
  width:var(--sidebar-w);background:var(--sidebar-bg);
  display:flex;flex-direction:column;align-items:center;padding:10px 0;
  position:fixed;top:0;left:0;bottom:0;z-index:200;
  transition:width .25s cubic-bezier(.4,0,.2,1),transform .25s cubic-bezier(.4,0,.2,1);
  overflow:hidden;box-shadow:2px 0 20px rgba(0,0,0,.15);
}
.sidebar:hover,.sidebar.open{width:var(--sidebar-full);}
.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:199;backdrop-filter:blur(2px);}
.sidebar-overlay.show{display:block;}

.sb-logo{width:100%;display:flex;align-items:center;gap:12px;padding:6px 13px 12px;border-bottom:1px solid rgba(255,255,255,.06);margin-bottom:6px;white-space:nowrap;overflow:hidden;}
.sb-logo-mark{width:38px;height:38px;border-radius:10px;flex-shrink:0;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(10,126,164,.4);}
.sb-logo-mark i{font-size:16px;color:#fff;}
.sb-logo-label{font-size:15px;font-weight:700;color:#fff;opacity:0;transition:opacity .2s;white-space:nowrap;}
.sb-logo-label span{color:#34D399;}
.sidebar:hover .sb-logo-label,.sidebar.open .sb-logo-label{opacity:1;}

.sb-section{font-size:9px;font-weight:600;letter-spacing:1.2px;color:rgba(255,255,255,.25);text-transform:uppercase;padding:10px 17px 3px;white-space:nowrap;width:100%;opacity:0;transition:opacity .2s;}
.sidebar:hover .sb-section,.sidebar.open .sb-section{opacity:1;}

.nav-item{
  display:flex;align-items:center;gap:11px;padding:8px 14px;margin:1px 6px;
  border-radius:var(--r-md);color:rgba(255,255,255,.5);cursor:pointer;
  transition:all .15s;white-space:nowrap;overflow:hidden;
  width:calc(100% - 12px);position:relative;
}
.nav-item:hover{background:rgba(255,255,255,.08);color:rgba(255,255,255,.9);}
.nav-item.active{background:linear-gradient(135deg,rgba(10,126,164,.3),rgba(22,163,74,.15));color:#fff;border:1px solid rgba(10,126,164,.25);}
.nav-item.active::before{content:'';position:absolute;left:0;top:20%;bottom:20%;width:3px;border-radius:0 3px 3px 0;background:linear-gradient(to bottom,#0A7EA4,#16A34A);}
.nav-icon{width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;}
.nav-item.active .nav-icon{background:rgba(10,126,164,.2);color:#34D399;}
.nav-label{font-size:13px;font-weight:500;opacity:0;transition:opacity .2s;flex:1;}
.sidebar:hover .nav-label,.sidebar.open .nav-label{opacity:1;}
.nav-badge{margin-left:auto;min-width:18px;height:18px;background:var(--accent);color:#fff;font-size:9px;font-weight:700;border-radius:9px;padding:0 5px;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;flex-shrink:0;}
.sidebar:hover .nav-badge,.sidebar.open .nav-badge{opacity:1;}
.nav-badge.warn{background:var(--warn);}

.sb-bottom{margin-top:auto;width:100%;border-top:1px solid rgba(255,255,255,.06);padding:10px 6px 0;}
.user-btn{display:flex;align-items:center;gap:10px;padding:8px 9px;border-radius:var(--r-md);cursor:pointer;transition:background .15s;white-space:nowrap;overflow:hidden;}
.user-btn:hover{background:rgba(255,255,255,.07);}
.user-av{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0;position:relative;}
.user-av::after{content:'';position:absolute;width:9px;height:9px;border-radius:50%;background:#22C55E;border:2px solid var(--sidebar-bg);bottom:0;right:0;}
.user-info{opacity:0;transition:opacity .2s;min-width:0;}
.sidebar:hover .user-info,.sidebar.open .user-info{opacity:1;}
.user-name{font-size:12px;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.user-role{font-size:10px;color:rgba(255,255,255,.4);}

/* BOTTOM NAV */
.bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;background:var(--sidebar-bg);border-top:1px solid rgba(255,255,255,.08);z-index:200;padding:6px 0 max(6px,env(safe-area-inset-bottom));}
.bn-inner{display:flex;justify-content:space-around;align-items:center;}
.bn-item{display:flex;flex-direction:column;align-items:center;gap:3px;padding:6px 12px;border-radius:10px;cursor:pointer;color:rgba(255,255,255,.45);transition:all .15s;min-width:50px;}
.bn-item.active{color:#34D399;}
.bn-item i{font-size:18px;}
.bn-item span{font-size:9px;font-weight:600;}
.bn-fab{width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px;cursor:pointer;box-shadow:0 4px 16px rgba(10,126,164,.4);transition:transform .15s;border:none;}
.bn-fab:hover{transform:scale(1.07);}

/* MAIN */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;transition:margin-left .25s cubic-bezier(.4,0,.2,1);}

/* TOPBAR */
.topbar{height:var(--topbar-h);background:var(--surface);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 16px;gap:10px;position:sticky;top:0;z-index:50;transition:background .3s,border-color .3s;}
.hamburger{display:none;width:36px;height:36px;border-radius:9px;align-items:center;justify-content:center;border:none;background:transparent;color:var(--text-sub);font-size:16px;cursor:pointer;transition:background .15s;flex-shrink:0;}
.hamburger:hover{background:var(--surface-2);}
.topbar-brand{display:none;align-items:center;gap:8px;font-size:14px;font-weight:700;color:var(--text);}
.topbar-brand .tb-mark{width:28px;height:28px;border-radius:7px;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;}
.topbar-brand .tb-mark i{font-size:12px;color:#fff;}
.topbar-brand span{color:#16A34A;}
.topbar-breadcrumb{display:flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:var(--text);}
.topbar-breadcrumb .sep{color:var(--text-hint);font-weight:300;}
.topbar-breadcrumb .cur{color:var(--primary);}

.search-bar{margin:0 auto;display:flex;align-items:center;gap:8px;background:var(--surface-2);border:1.5px solid var(--border);border-radius:24px;padding:6px 16px;width:300px;transition:all .2s;}
.search-bar:focus-within{border-color:var(--primary);box-shadow:0 0 0 3px var(--primary-glow);width:360px;}
.search-bar i{color:var(--text-hint);font-size:12px;}
.search-bar input{border:none;background:transparent;outline:none;font-family:inherit;font-size:13px;color:var(--text);width:100%;}
.search-bar input::placeholder{color:var(--text-hint);}

.topbar-right{display:flex;align-items:center;gap:6px;}
.tb-icon-btn{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text-sub);font-size:13px;transition:all .15s;border:none;background:transparent;position:relative;flex-shrink:0;}
.tb-icon-btn:hover{background:var(--surface-2);color:var(--primary);}
.tb-icon-btn .ndot{width:7px;height:7px;border-radius:50%;background:var(--danger);border:2px solid var(--surface);position:absolute;top:4px;right:4px;}
.theme-toggle{width:46px;height:26px;border-radius:13px;background:var(--border-2);cursor:pointer;position:relative;transition:background .3s;border:none;flex-shrink:0;}
[data-theme="dark"] .theme-toggle{background:var(--primary);}
.theme-toggle::before{content:'';position:absolute;width:20px;height:20px;border-radius:50%;background:#fff;top:3px;left:3px;transition:transform .3s cubic-bezier(.4,0,.2,1);box-shadow:0 2px 5px rgba(0,0,0,.2);}
[data-theme="dark"] .theme-toggle::before{transform:translateX(20px);}
.btn-new{display:flex;align-items:center;gap:6px;background:linear-gradient(135deg,#0A7EA4,#16A34A);color:#fff;border:none;border-radius:8px;padding:7px 14px;font-family:inherit;font-size:12px;font-weight:600;cursor:pointer;transition:opacity .15s,transform .15s;box-shadow:0 3px 10px rgba(10,126,164,.25);white-space:nowrap;}
.btn-new:hover{opacity:.9;transform:translateY(-1px);}

/* CONTENT */
.content{padding:20px 24px;flex:1;}

/* CARDS */
.card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);box-shadow:var(--shadow-sm);transition:background .3s,border-color .3s;}

/* SECTION HEAD */
.sec-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;}
.sec-title{font-size:14px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:8px;}
.sec-link{font-size:12px;color:var(--primary);font-weight:500;}
.sec-link:hover{opacity:.7;}

/* BADGES */
.badge{font-size:10px;font-weight:600;padding:2px 9px;border-radius:100px;white-space:nowrap;}
.badge-green{background:var(--accent-light);color:var(--accent);}
.badge-blue{background:var(--primary-light);color:var(--primary);}
.badge-warn{background:var(--warn-light);color:var(--warn);}
.badge-danger{background:var(--danger-light);color:var(--danger);}
.badge-gray{background:var(--surface-2);color:var(--text-hint);border:1px solid var(--border);}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:7px;padding:8px 16px;border-radius:8px;border:none;font-family:inherit;font-size:13px;font-weight:600;cursor:pointer;transition:all .15s;}
.btn-primary{background:linear-gradient(135deg,#0A7EA4,#16A34A);color:#fff;box-shadow:0 3px 10px rgba(10,126,164,.2);}
.btn-primary:hover{opacity:.9;}
.btn-secondary{background:var(--surface-2);color:var(--text-sub);border:1px solid var(--border);}
.btn-secondary:hover{border-color:var(--primary);color:var(--primary);}
.btn-danger{background:var(--danger);color:#fff;}
.btn-danger:hover{opacity:.85;}
.btn-sm{padding:5px 12px;font-size:12px;}

/* FORMS */
.form-group{margin-bottom:16px;}
.form-label{display:block;font-size:13px;font-weight:500;color:var(--text);margin-bottom:5px;}
.form-control{width:100%;padding:9px 12px;border:1.5px solid var(--border);border-radius:8px;background:var(--surface);color:var(--text);font-family:inherit;font-size:13px;outline:none;transition:border-color .15s,box-shadow .15s;}
.form-control:focus{border-color:var(--primary);box-shadow:0 0 0 3px var(--primary-glow);}
.form-control::placeholder{color:var(--text-hint);}
select.form-control{cursor:pointer;}

/* TABLES */
.table-wrap{overflow-x:auto;}
table{width:100%;border-collapse:collapse;}
th{font-size:11px;font-weight:600;color:var(--text-sub);text-transform:uppercase;letter-spacing:.6px;padding:10px 14px;border-bottom:1px solid var(--border);text-align:left;white-space:nowrap;}
td{padding:12px 14px;border-bottom:1px solid var(--border);font-size:13px;color:var(--text);vertical-align:middle;}
tr:last-child td{border-bottom:none;}
tr:hover td{background:var(--surface-2);}

/* ALERTS */
.alert{padding:12px 16px;border-radius:9px;font-size:13px;display:flex;align-items:center;gap:10px;margin-bottom:16px;}
.alert-success{background:var(--accent-light);color:var(--accent);border:1px solid rgba(22,163,74,.2);}
.alert-danger{background:var(--danger-light);color:var(--danger);border:1px solid rgba(220,38,38,.2);}
.alert-info{background:var(--primary-light);color:var(--primary);border:1px solid rgba(10,126,164,.2);}

::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:10px;}

/* RESPONSIVE */
@media(max-width:1024px){
  .sidebar{transform:translateX(-100%);width:var(--sidebar-full) !important;}
  .sidebar.open{transform:translateX(0);}
  .sidebar:hover{width:var(--sidebar-full) !important;}
  .sidebar.open .nav-label,.sidebar.open .sb-section,.sidebar.open .nav-badge,.sidebar.open .sb-logo-label,.sidebar.open .user-info{opacity:1 !important;}
  .hamburger{display:flex;}
  .topbar-breadcrumb{display:none;}
  .topbar-brand{display:flex;}
  .search-bar{width:200px;}
  .search-bar:focus-within{width:240px;}
  .main{margin-left:0;}
}
@media(max-width:640px){
  .sidebar{display:none;}
  .sidebar.open{display:flex;width:var(--sidebar-full) !important;transform:translateX(0);}
  .bottom-nav{display:flex;}
  .main{margin-left:0;padding-bottom:70px;}
  .content{padding:12px 14px;}
  .search-bar{display:none;}
  .btn-new{display:none;}
  .topbar{padding:0 12px;gap:8px;}
  .topbar-brand{display:flex;}
}
</style>
@yield('styles')
</head>
<body>

<div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
  <div class="sb-logo">
    <div class="sb-logo-mark"><i class="fa-solid fa-calendar-check"></i></div>
    <div class="sb-logo-label">Smart<span>Meeting</span></div>
  </div>

  <div class="sb-section">Principal</div>
  <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-house"></i></div>
    <span class="nav-label">Tableau de bord</span>
  </a>
  <a href="{{ route('calendar') }}" class="nav-item {{ request()->routeIs('calendar') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-calendar"></i></div>
    <span class="nav-label">Calendrier</span>
  </a>
  <a href="{{ route('meetings.index') }}" class="nav-item {{ request()->routeIs('meetings.*') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-calendar-days"></i></div>
    <span class="nav-label">Réunions</span>
    @php $upcomingCount = \App\Models\Meeting::where('statut','A venir')->count(); @endphp
    @if($upcomingCount > 0)<span class="nav-badge">{{ $upcomingCount }}</span>@endif
  </a>
  <a href="{{ route('tasks.index') }}" class="nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-list-check"></i></div>
    <span class="nav-label">Tâches</span>
    @php $pendingCount = \App\Models\Task::where('statut','En cours')->count(); @endphp
    @if($pendingCount > 0)<span class="nav-badge warn">{{ $pendingCount }}</span>@endif
  </a>
  <a href="{{ route('report.index') }}" class="nav-item {{ request()->routeIs('report.*') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-file-lines"></i></div>
    <span class="nav-label">Comptes rendus</span>
  </a>

  <div class="sb-section">Analyse</div>
  <a href="{{ route('stats.index') }}" class="nav-item {{ request()->routeIs('stats.*') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-chart-line"></i></div>
    <span class="nav-label">Statistiques</span>
  </a>
  <a href="{{ route('participants.index') }}" class="nav-item {{ request()->routeIs('participants.*') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-users"></i></div>
    <span class="nav-label">Participants</span>
  </a>

  <div class="sb-section">Compte</div>
  <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
    <div class="nav-icon"><i class="fa-solid fa-gear"></i></div>
    <span class="nav-label">Paramètres</span>
  </a>

  <div class="sb-bottom">
    <div class="user-btn">
      <div class="user-av">{{ strtoupper(substr(Auth::user()->name,0,2)) }}</div>
      <div class="user-info">
        <div class="user-name">{{ Auth::user()->name }}</div>
        <div class="user-role">{{ Auth::user()->role }}</div>
      </div>
    </div>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:4px;">
      @csrf
      <button type="submit" class="nav-item" style="width:calc(100% - 12px);border:none;background:none;text-align:left;color:rgba(255,255,255,.4);">
        <div class="nav-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
        <span class="nav-label">Déconnexion</span>
      </button>
    </form>
  </div>
</aside>

<div class="main">
  <header class="topbar">
    <button class="hamburger" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
    <div class="topbar-brand">
      <div class="tb-mark"><i class="fa-solid fa-calendar-check"></i></div>
      Smart<span>Meeting</span>
    </div>
    <div class="topbar-breadcrumb">
      <span>SmartMeeting</span>
      <span class="sep">/</span>
      <span class="cur">@yield('title','Dashboard')</span>
    </div>
    <div class="search-bar">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" placeholder="Rechercher..."/>
    </div>
    <div class="topbar-right">
      <button class="tb-icon-btn"><i class="fa-solid fa-bell"></i><div class="ndot"></div></button>
      <button class="theme-toggle" onclick="toggleTheme()" title="Thème"></button>
      <a href="{{ route('calendar') }}" class="btn-new" style="background:linear-gradient(135deg,#086B8C,#0A7EA4);">
        <i class="fa-solid fa-calendar"></i> Calendrier
      </a>
      <a href="{{ route('meetings.create') }}" class="btn-new">
        <i class="fa-solid fa-plus"></i> Nouvelle réunion
      </a>
    </div>
  </header>

  <div class="content">
    @if(session('success'))
      <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
    @endif
    @yield('content')
  </div>
</div>

<nav class="bottom-nav">
  <div class="bn-inner">
    <a href="{{ route('dashboard') }}" class="bn-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <i class="fa-solid fa-house"></i><span>Accueil</span>
    </a>
    <a href="{{ route('calendar') }}" class="bn-item {{ request()->routeIs('calendar') ? 'active' : '' }}">
      <i class="fa-solid fa-calendar"></i><span>Calendrier</span>
    </a>
    <a href="{{ route('meetings.index') }}" class="bn-item {{ request()->routeIs('meetings.*') ? 'active' : '' }}">
      <i class="fa-solid fa-calendar-days"></i><span>Réunions</span>
    </a>
    <a href="{{ route('meetings.create') }}"><button class="bn-fab"><i class="fa-solid fa-plus"></i></button></a>
    <a href="{{ route('tasks.index') }}" class="bn-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
      <i class="fa-solid fa-list-check"></i><span>Tâches</span>
    </a>
    <a href="{{ route('stats.index') }}" class="bn-item {{ request()->routeIs('stats.*') ? 'active' : '' }}">
      <i class="fa-solid fa-chart-line"></i><span>Stats</span>
    </a>
  </div>
</nav>

<script>
const html = document.documentElement;
const saved = localStorage.getItem('sm-theme') || 'light';
html.setAttribute('data-theme', saved);
function toggleTheme(){
  const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
  html.setAttribute('data-theme', next);
  localStorage.setItem('sm-theme', next);
}
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('overlay').classList.toggle('show');
}
function closeSidebar(){
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('overlay').classList.remove('show');
}
setTimeout(()=>{ document.querySelectorAll('.alert').forEach(a=>a.style.display='none'); }, 4000);
</script>
@yield('scripts')
</body>
</html>
