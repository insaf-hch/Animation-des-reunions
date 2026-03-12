<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<title>SmartMeeting — {{ $meeting->titre }}</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
  --primary:#0A7EA4;--accent:#16A34A;--warn:#D97706;--danger:#DC2626;
  --bg:#0D1117;--surface:#161B22;--surface-2:#1C2128;--surface-3:#21262D;
  --border:rgba(255,255,255,.08);--border-2:rgba(255,255,255,.12);
  --text:#E6EDF3;--text-sub:#8B949E;--text-hint:#484F58;
  --r-sm:6px;--r-md:10px;--r-lg:14px;--r-xl:18px;
  font-family:'Outfit',sans-serif;
}
html,body{height:100%;overflow:hidden;}
body{background:var(--bg);color:var(--text);display:flex;flex-direction:column;}

/* TOPBAR */
.topbar{height:52px;flex-shrink:0;background:var(--surface);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 16px;gap:12px;z-index:100;}
.logo{display:flex;align-items:center;gap:9px;text-decoration:none;}
.logo-mark{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;}
.logo-mark i{font-size:14px;color:#fff;}
.logo-name{font-size:14px;font-weight:700;color:var(--text);}
.logo-name span{color:#34D399;}
.divider{width:1px;height:20px;background:var(--border-2);}
.meeting-title{font-size:13px;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:260px;}
.live-badge{display:flex;align-items:center;gap:5px;padding:3px 10px;border-radius:100px;background:rgba(220,38,38,.15);border:1px solid rgba(220,38,38,.25);font-size:10px;font-weight:700;color:#FC8181;white-space:nowrap;flex-shrink:0;}
.live-dot{width:6px;height:6px;border-radius:50%;background:#FC8181;animation:blink 1.2s infinite;}
@keyframes blink{0%,100%{opacity:1;}50%{opacity:.3;}}
.topbar-timer{font-size:13px;font-weight:700;color:var(--text);font-variant-numeric:tabular-nums;background:var(--surface-2);padding:4px 12px;border-radius:7px;border:1px solid var(--border);letter-spacing:.5px;}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:8px;}
.tb-btn{display:flex;align-items:center;gap:6px;padding:6px 12px;border-radius:8px;border:1px solid var(--border);background:var(--surface-2);color:var(--text-sub);font-family:inherit;font-size:12px;font-weight:500;cursor:pointer;transition:all .15s;white-space:nowrap;}
.tb-btn:hover{border-color:var(--primary);color:var(--primary);}
.end-btn{display:flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;border:none;background:var(--danger);color:#fff;font-family:inherit;font-size:12px;font-weight:600;cursor:pointer;transition:opacity .15s;box-shadow:0 3px 12px rgba(220,38,38,.3);}
.end-btn:hover{opacity:.85;}

/* ROOM */
.room{flex:1;display:flex;overflow:hidden;height:calc(100vh - 52px);min-height:0;}

/* VIDEO AREA */
.video-area{flex:1;display:flex;flex-direction:column;background:var(--bg);min-width:0;position:relative;overflow:hidden;}
.video-grid{flex:1;display:grid;gap:6px;padding:10px;overflow:hidden;min-height:0;}
.grid-1{grid-template-columns:1fr;grid-template-rows:1fr;}
.grid-2{grid-template-columns:repeat(2,1fr);grid-template-rows:1fr;}
.grid-3{grid-template-columns:repeat(2,1fr);grid-template-rows:repeat(2,1fr);}
.grid-4{grid-template-columns:repeat(2,1fr);grid-template-rows:repeat(2,1fr);}

.vcell{position:relative;border-radius:var(--r-lg);overflow:hidden;background:var(--surface-2);border:2px solid transparent;min-height:0;min-width:0;transition:border-color .2s,box-shadow .2s;}
.vcell.you{border-color:rgba(10,126,164,.5);}
.vcell.speaking{border-color:var(--accent);box-shadow:0 0 0 2px rgba(22,163,74,.2);}
video{width:100%;height:100%;object-fit:cover;display:block;transform:scaleX(-1);background:#000;}
video.screen{transform:none;}
.cam-placeholder{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;background:linear-gradient(135deg,rgba(255,255,255,.03),rgba(255,255,255,.01));}
.big-avatar{width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:26px;font-weight:700;color:#fff;box-shadow:0 4px 20px rgba(0,0,0,.3);}
.cam-placeholder p{font-size:12px;color:var(--text-sub);}
.cam-off-overlay{position:absolute;inset:0;display:none;flex-direction:column;align-items:center;justify-content:center;gap:10px;background:var(--surface-2);z-index:2;}
.cam-off-overlay.show{display:flex;}
.cam-off-av{width:76px;height:76px;border-radius:50%;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:700;color:#fff;}
.cam-off-overlay p{font-size:12px;color:var(--text-sub);}
.nametag{position:absolute;bottom:10px;left:10px;background:rgba(0,0,0,.65);backdrop-filter:blur(8px);color:#fff;font-size:11px;font-weight:600;padding:4px 10px;border-radius:7px;display:flex;align-items:center;gap:6px;z-index:3;}
.nametag .mic-muted{color:var(--danger);font-size:9px;}
.you-tag{position:absolute;top:10px;right:10px;background:rgba(10,126,164,.75);backdrop-filter:blur(6px);color:#fff;font-size:10px;font-weight:700;padding:3px 9px;border-radius:6px;z-index:3;}
.screen-banner{display:none;position:absolute;top:10px;left:50%;transform:translateX(-50%);background:rgba(10,126,164,.9);backdrop-filter:blur(8px);color:#fff;padding:6px 16px;border-radius:8px;font-size:12px;font-weight:600;z-index:10;align-items:center;gap:8px;}
.screen-banner.show{display:flex;}
.stop-share{padding:3px 10px;border-radius:5px;border:1px solid rgba(255,255,255,.3);background:transparent;color:#fff;font-family:inherit;font-size:11px;cursor:pointer;}

/* CONTROLS */
.controls{height:80px;flex-shrink:0;background:var(--surface);border-top:1px solid var(--border);display:flex;align-items:center;justify-content:center;gap:8px;padding:0 20px;position:relative;}
.ctrl{display:flex;flex-direction:column;align-items:center;gap:4px;cursor:pointer;transition:all .15s;user-select:none;}
.ctrl-circle{width:46px;height:46px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:17px;border:none;cursor:pointer;transition:all .2s cubic-bezier(.4,0,.2,1);}
.ctrl-label{font-size:10px;font-weight:500;color:var(--text-sub);transition:color .15s;}
.ctrl-circle.on{background:var(--surface-3);color:var(--text);box-shadow:0 2px 8px rgba(0,0,0,.3);}
.ctrl-circle.on:hover{background:var(--surface-2);transform:scale(1.06);}
.ctrl-circle.off{background:rgba(220,38,38,.2);color:var(--danger);border:1px solid rgba(220,38,38,.25);}
.ctrl-circle.off:hover{background:rgba(220,38,38,.3);transform:scale(1.06);}
.ctrl-circle.active-screen{background:rgba(10,126,164,.2);color:var(--primary);border:1px solid rgba(10,126,164,.3);}
.ctrl-circle.neutral{background:var(--surface-3);color:var(--text-sub);}
.ctrl-circle.neutral:hover{background:var(--surface-2);color:var(--text);transform:scale(1.06);}
.ctrl-circle.end{background:var(--danger);color:#fff;width:50px;height:50px;font-size:18px;box-shadow:0 4px 16px rgba(220,38,38,.4);}
.ctrl-circle.end:hover{background:#B91C1C;transform:scale(1.08);}
.sep-v{width:1px;height:36px;background:var(--border-2);margin:0 4px;}

/* SIDE PANEL */
.side-panel{width:290px;flex-shrink:0;background:var(--surface);border-left:1px solid var(--border);display:flex;flex-direction:column;transition:width .25s cubic-bezier(.4,0,.2,1),opacity .25s;}
.side-panel.hidden{width:0;opacity:0;pointer-events:none;overflow:hidden;}
.ptabs{display:flex;border-bottom:1px solid var(--border);flex-shrink:0;}
.ptab{flex:1;padding:11px 6px;text-align:center;font-size:11px;font-weight:500;color:var(--text-sub);cursor:pointer;border-bottom:2px solid transparent;margin-bottom:-1px;transition:all .15s;}
.ptab:hover{color:var(--text);}
.ptab.active{color:var(--primary);border-bottom-color:var(--primary);font-weight:600;}
.tab-body{flex:1;overflow-y:auto;padding:14px;}
.tab-body::-webkit-scrollbar{width:3px;}
.tab-body::-webkit-scrollbar-thumb{background:var(--border);border-radius:10px;}

.p-count-label{font-size:10px;color:var(--text-hint);margin-bottom:10px;text-transform:uppercase;letter-spacing:.8px;font-weight:600;}
.pitem{display:flex;align-items:center;gap:10px;padding:8px 9px;border-radius:9px;transition:background .15s;margin-bottom:3px;}
.pitem:hover{background:rgba(255,255,255,.04);}
.pav{width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0;position:relative;}
.pav::after{content:'';position:absolute;width:9px;height:9px;border-radius:50%;bottom:0;right:0;border:2px solid var(--surface);}
.online::after{background:#22C55E;}
.pname{font-size:12px;font-weight:500;color:var(--text);}
.prole{font-size:10px;color:var(--text-hint);}
.picons{margin-left:auto;display:flex;gap:5px;}
.picon{font-size:11px;}
.picon.ok{color:var(--accent);}
.picon.muted{color:var(--danger);}
.you-label{font-size:9px;font-weight:700;padding:1px 6px;border-radius:4px;background:rgba(10,126,164,.2);color:var(--primary);margin-left:4px;}

.agenda-item{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:9px;border:1px solid var(--border);margin-bottom:6px;background:var(--surface-2);transition:border-color .15s;}
.agenda-item.current{border-color:var(--primary);background:rgba(10,126,164,.08);}
.agenda-item.done{opacity:.45;}
.anum{width:24px;height:24px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;flex-shrink:0;}
.atitle{flex:1;font-size:12px;color:var(--text);}
.agenda-item.current .atitle{font-weight:600;color:var(--primary);}
.adur{font-size:10px;color:var(--text-hint);}

.invite-section{margin-bottom:16px;}
.invite-title{font-size:12px;font-weight:600;color:var(--text);margin-bottom:10px;display:flex;align-items:center;gap:7px;}
.link-row{display:flex;align-items:center;gap:6px;background:var(--bg);border:1px solid var(--border);border-radius:8px;padding:8px 10px;margin-bottom:8px;}
.link-row span{flex:1;font-size:10px;color:var(--text-hint);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-family:monospace;}
.copy-btn{padding:4px 10px;border-radius:6px;border:1px solid var(--border);background:var(--surface-2);color:var(--text-sub);font-family:inherit;font-size:10px;cursor:pointer;transition:all .15s;}
.copy-btn:hover{border-color:var(--primary);color:var(--primary);}
.copy-btn.done{border-color:var(--accent);color:var(--accent);}
.platform-btns{display:flex;gap:6px;margin-bottom:14px;}
.pf-btn{flex:1;padding:8px 4px;border-radius:8px;border:1px solid var(--border);background:var(--surface-2);color:var(--text-sub);font-family:inherit;font-size:11px;font-weight:500;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:5px;transition:all .15s;}
.pf-btn:hover{border-color:var(--primary);color:var(--primary);}
.email-row{display:flex;gap:6px;margin-bottom:6px;}
.email-input{flex:1;padding:8px 10px;border-radius:8px;border:1px solid var(--border);background:var(--surface-2);color:var(--text);font-family:inherit;font-size:12px;outline:none;transition:border-color .15s;}
.email-input:focus{border-color:var(--primary);}
.email-input::placeholder{color:var(--text-hint);}
.send-btn{padding:8px 14px;border-radius:8px;border:none;background:var(--primary);color:#fff;font-family:inherit;font-size:12px;font-weight:600;cursor:pointer;}

/* PERM MODAL */
.perm-overlay{position:fixed;inset:0;background:rgba(0,0,0,.85);backdrop-filter:blur(12px);z-index:999;display:flex;align-items:center;justify-content:center;}
.perm-card{background:var(--surface);border-radius:20px;border:1px solid var(--border-2);padding:36px 32px;max-width:400px;width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.5);animation:popIn .3s cubic-bezier(.34,1.56,.64,1);}
@keyframes popIn{from{opacity:0;transform:scale(.88);}to{opacity:1;transform:scale(1);}}
.perm-icon{width:76px;height:76px;border-radius:50%;background:linear-gradient(135deg,rgba(10,126,164,.2),rgba(22,163,74,.1));border:1px solid rgba(10,126,164,.25);display:flex;align-items:center;justify-content:center;font-size:30px;color:var(--primary);margin:0 auto 20px;}
.perm-title{font-size:20px;font-weight:700;margin-bottom:8px;}
.perm-desc{font-size:13px;color:var(--text-sub);line-height:1.65;margin-bottom:24px;}
.perm-desc strong{color:var(--text);}
.perm-actions{display:flex;gap:10px;}
.perm-allow{flex:1;padding:12px;border-radius:10px;border:none;background:linear-gradient(135deg,#0A7EA4,#16A34A);color:#fff;font-family:inherit;font-size:14px;font-weight:600;cursor:pointer;transition:opacity .15s;box-shadow:0 4px 16px rgba(10,126,164,.3);}
.perm-allow:hover{opacity:.9;}
.perm-deny{padding:12px 18px;border-radius:10px;border:1px solid var(--border-2);background:transparent;color:var(--text-sub);font-family:inherit;font-size:14px;cursor:pointer;transition:all .15s;}
.perm-deny:hover{border-color:var(--danger);color:var(--danger);}

/* TOAST */
.toast{position:fixed;bottom:96px;left:50%;transform:translateX(-50%) translateY(10px);background:rgba(22,27,34,.92);backdrop-filter:blur(12px);color:var(--text);padding:10px 20px;border-radius:10px;font-size:13px;font-weight:500;border:1px solid var(--border-2);box-shadow:0 8px 24px rgba(0,0,0,.4);opacity:0;transition:opacity .25s,transform .25s;pointer-events:none;white-space:nowrap;z-index:500;}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

@media(max-width:900px){.side-panel:not(.hidden){width:260px;}.meeting-title{max-width:160px;}}
@media(max-width:700px){.side-panel{display:none !important;}.ctrl-circle{width:42px;height:42px;font-size:15px;}.ctrl-label{display:none;}.controls{gap:6px;height:68px;}.sep-v{display:none;}.tb-btn{display:none;}.meeting-title,.divider{display:none;}.topbar{padding:0 12px;gap:10px;}}
@media(max-width:480px){.grid-2,.grid-3,.grid-4{grid-template-columns:1fr;}}
</style>
</head>
<body>
<!-- PERMISSION MODAL -->
<div class="perm-overlay" id="permOverlay">
  <div class="perm-card">
    <div class="perm-icon"><i class="fa-solid fa-video"></i></div>
    <div class="perm-title">Rejoindre la réunion</div>
    <div class="perm-desc">SmartMeeting a besoin d'accéder à votre <strong>caméra</strong> et votre <strong>microphone</strong> pour participer.</div>
    <div class="perm-actions">
      <button class="perm-allow" onclick="startCamera()"><i class="fa-solid fa-video"></i>&nbsp; Autoriser et rejoindre</button>
      <button class="perm-deny" onclick="joinWithoutCam()">Sans caméra</button>
    </div>
  </div>
</div>

<!-- TOPBAR -->
<header class="topbar">
  <a href="{{ route('dashboard') }}" class="logo">
    <div class="logo-mark"><i class="fa-solid fa-calendar-check"></i></div>
    <div class="logo-name">Smart<span>Meeting</span></div>
  </a>
  <div class="divider"></div>
  <div class="meeting-title">{{ $meeting->titre }}</div>
  <div class="live-badge"><div class="live-dot"></div> EN DIRECT</div>
  <div class="topbar-timer" id="topTimer">00:00</div>
  <div class="topbar-right">
    <button class="tb-btn" onclick="togglePanel('participants')">
      <i class="fa-solid fa-users"></i> {{ $meeting->participants->count() }} participants
    </button>
    <button class="tb-btn" onclick="togglePanel('invite')">
      <i class="fa-solid fa-user-plus"></i> Inviter
    </button>
    <form method="POST" action="{{ route('meetings.end', $meeting->id) }}" style="display:inline;" onsubmit="return confirm('Terminer la réunion ?')">
      @csrf @method('PATCH')
      <button type="submit" class="end-btn"><i class="fa-solid fa-phone-slash"></i> Terminer</button>
    </form>
  </div>
</header>

<!-- ROOM -->
<div class="room">
  <div class="video-area">
    <div class="screen-banner" id="screenBanner">
      <i class="fa-solid fa-display"></i> Vous partagez votre écran
      <button class="stop-share" onclick="stopScreen()">Arrêter</button>
    </div>

    @php
      $count = max(1, $meeting->participants->count());
      $gridClass = $count === 1 ? 'grid-1' : ($count === 2 ? 'grid-2' : ($count === 3 ? 'grid-3' : 'grid-4'));
      $colors = ['#0A7EA4','#16A34A','#7C3AED','#D97706','#DC2626','#0891B2','#BE185D','#0369A1'];
    @endphp

    <div class="video-grid {{ $gridClass }}" id="videoGrid">
      <!-- YOU -->
      <div class="vcell you" id="myCell">
        <video id="myVideo" autoplay muted playsinline></video>
        <div class="cam-off-overlay" id="myCamOff">
          <div class="cam-off-av">{{ strtoupper(substr(Auth::user()->name,0,2)) }}</div>
          <p>Caméra désactivée</p>
        </div>
        <div class="you-tag">Vous</div>
        <div class="nametag">
          {{ Auth::user()->name }}
          <span class="mic-muted" id="myMicMuted" style="display:none;"><i class="fa-solid fa-microphone-slash"></i></span>
        </div>
      </div>

      <!-- OTHER PARTICIPANTS -->
      @foreach($meeting->participants->where('user_id','!=',Auth::id())->take(3) as $i => $p)
      <div class="vcell {{ $i === 0 ? 'speaking' : '' }}">
        <div class="cam-placeholder">
          <div class="big-avatar" style="background:{{ $colors[($i+1) % count($colors)] }};">
            {{ strtoupper(substr($p->user->name ?? '?',0,2)) }}
          </div>
          <p>{{ $p->user->name ?? 'Participant' }}</p>
        </div>
        <div class="nametag">
          {{ $p->user->name ?? 'Participant' }}
          @if($i === 0)
            <i class="fa-solid fa-microphone" style="color:var(--accent);font-size:9px;"></i>
          @else
            <span class="mic-muted"><i class="fa-solid fa-microphone-slash"></i></span>
          @endif
        </div>
      </div>
      @endforeach
    </div>

    <!-- CONTROLS -->
    <div class="controls">
      <div class="ctrl" onclick="toggleMic()">
        <button class="ctrl-circle on" id="micCircle"><i class="fa-solid fa-microphone" id="micIcon"></i></button>
        <span class="ctrl-label" id="micLabel">Micro</span>
      </div>
      <div class="ctrl" onclick="toggleCam()">
        <button class="ctrl-circle on" id="camCircle"><i class="fa-solid fa-video" id="camIcon"></i></button>
        <span class="ctrl-label" id="camLabel">Caméra</span>
      </div>
      <div class="ctrl" onclick="toggleScreen()">
        <button class="ctrl-circle neutral" id="screenCircle"><i class="fa-solid fa-display" id="screenIcon"></i></button>
        <span class="ctrl-label" id="screenLabel">Partager</span>
      </div>
      <div class="sep-v"></div>
      <div class="ctrl" onclick="togglePanel('participants')">
        <button class="ctrl-circle neutral"><i class="fa-solid fa-users"></i></button>
        <span class="ctrl-label">Participants</span>
      </div>
      <div class="ctrl" onclick="togglePanel('invite')">
        <button class="ctrl-circle neutral"><i class="fa-solid fa-user-plus"></i></button>
        <span class="ctrl-label">Inviter</span>
      </div>
      <div class="ctrl" onclick="togglePanel('agenda')">
        <button class="ctrl-circle neutral"><i class="fa-solid fa-list-check"></i></button>
        <span class="ctrl-label">Agenda</span>
      </div>
      <div class="sep-v"></div>
      <div class="ctrl" onclick="endMeeting()">
        <button class="ctrl-circle end"><i class="fa-solid fa-phone-slash"></i></button>
        <span class="ctrl-label" style="color:var(--danger);">Quitter</span>
      </div>
    </div>
  </div>

  <!-- SIDE PANEL -->
  <aside class="side-panel hidden" id="sidePanel">
    <div class="ptabs">
      <div class="ptab" id="ptab-participants" onclick="showTab('participants')"><i class="fa-solid fa-users"></i> Participants</div>
      <div class="ptab" id="ptab-agenda" onclick="showTab('agenda')"><i class="fa-solid fa-list-check"></i> Agenda</div>
      <div class="ptab" id="ptab-invite" onclick="showTab('invite')"><i class="fa-solid fa-user-plus"></i> Inviter</div>
    </div>

    <!-- PARTICIPANTS -->
    <div class="tab-body" id="tab-participants" style="display:none;">
      <div class="p-count-label">En réunion · {{ $meeting->participants->count() }} participants</div>
      @foreach($meeting->participants as $i => $p)
      @php $colors2 = ['#0A7EA4','#16A34A','#7C3AED','#D97706','#DC2626','#0891B2']; @endphp
      <div class="pitem">
        <div class="pav online" style="background:{{ $colors2[$i % count($colors2)] }};">{{ strtoupper(substr($p->user->name ?? '?',0,2)) }}</div>
        <div style="flex:1;min-width:0;">
          <div class="pname">{{ $p->user->name ?? 'Inconnu' }}
            @if($p->user_id === Auth::id())<span class="you-label">Vous</span>@endif
          </div>
          <div class="prole">{{ $p->role_reunion }}</div>
        </div>
        <div class="picons">
          @if($p->user_id === Auth::id())
            <i class="picon ok fa-solid fa-microphone" id="pm-mic"></i>
            <i class="picon ok fa-solid fa-video" id="pm-cam"></i>
          @else
            <i class="picon {{ $i===1?'ok':'muted' }} fa-solid fa-microphone{{ $i===1?'':'-slash' }}"></i>
            <i class="picon ok fa-solid fa-video"></i>
          @endif
        </div>
      </div>
      @endforeach
    </div>

    <!-- AGENDA -->
    <div class="tab-body" id="tab-agenda" style="display:none;">
      <div class="p-count-label">Ordre du jour</div>
      @forelse($meeting->agendas->sortBy('ordre') as $i => $agenda)
      <div class="agenda-item {{ $i===1?'current':($i===0?'done':'') }}">
        <div class="anum" style="background:{{ $i===0?'var(--accent)':($i===1?'var(--primary)':'var(--surface-3)') }};color:{{ $i<2?'#fff':'var(--text-sub)' }};border:{{ $i>=2?'1px solid var(--border)':'' }};">
          {{ $i===0?'✓':($i+1) }}
        </div>
        <div class="atitle">{{ $agenda->titre }}</div>
        <div class="adur">{{ $agenda->duree }}min</div>
      </div>
      @empty
      <div style="text-align:center;padding:20px;color:var(--text-hint);font-size:12px;">
        <i class="fa-solid fa-list" style="font-size:24px;display:block;margin-bottom:8px;"></i>
        Aucun point à l'ordre du jour
      </div>
      @endforelse
    </div>

    <!-- INVITE -->
    <div class="tab-body" id="tab-invite" style="display:none;">
      <div class="invite-section">
        <div class="invite-title"><i class="fa-solid fa-link" style="color:var(--primary);"></i> Lien d'invitation</div>
        <div class="link-row">
          <span id="inviteLink">{{ url('/meetings/'.$meeting->id.'/join') }}</span>
          <button class="copy-btn" id="copyBtn" onclick="copyLink()">Copier</button>
        </div>
        <div class="platform-btns">
          @if($meeting->lien_reunion)
          <a href="{{ $meeting->lien_reunion }}" target="_blank" class="pf-btn">
            <i class="fa-solid fa-video" style="color:#2D8CFF;"></i> Rejoindre
          </a>
          @else
          <button class="pf-btn"><i class="fa-brands fa-microsoft" style="color:#0A7EA4;"></i> Teams</button>
          <button class="pf-btn"><i class="fa-solid fa-video" style="color:#2D8CFF;"></i> Zoom</button>
          <button class="pf-btn"><i class="fa-brands fa-google" style="color:#EA4335;"></i> Meet</button>
          @endif
        </div>
      </div>
      <div class="invite-title"><i class="fa-solid fa-paper-plane" style="color:var(--primary);"></i> Inviter par email</div>
      <div class="email-row">
        <input type="email" class="email-input" placeholder="email@exemple.com" id="emailInput"/>
        <button class="send-btn" onclick="sendInvite()">Envoyer</button>
      </div>
      <p style="font-size:10px;color:var(--text-hint);"><i class="fa-solid fa-circle-info"></i> Le lien expire dans 24h</p>
    </div>
  </aside>
</div>

<div class="toast" id="toast"></div>

<script>
let micOn=true,camOn=true,screenOn=false,panelOpen=false,activeTab='';
let stream=null,screenStream=null,timerSec=0,timerInterval;

function startTimer(){
  timerInterval=setInterval(()=>{
    timerSec++;
    const m=String(Math.floor(timerSec/60)).padStart(2,'0');
    const s=String(timerSec%60).padStart(2,'0');
    document.getElementById('topTimer').textContent=m+':'+s;
  },1000);
}

async function startCamera(){
  document.getElementById('permOverlay').style.display='none';
  try{
    stream=await navigator.mediaDevices.getUserMedia({video:true,audio:true});
    document.getElementById('myVideo').srcObject=stream;
    toast('📹 Caméra et microphone activés');
  }catch(e){joinWithoutCam();return;}
  startTimer();
}

function joinWithoutCam(){
  document.getElementById('permOverlay').style.display='none';
  camOn=false;
  document.getElementById('myCamOff').classList.add('show');
  updateCamUI();
  toast('🎙️ Connecté en mode audio uniquement');
  startTimer();
  navigator.mediaDevices.getUserMedia({audio:true}).then(s=>{stream=s;}).catch(()=>{});
}

function toggleMic(){
  micOn=!micOn;
  if(stream)stream.getAudioTracks().forEach(t=>t.enabled=micOn);
  updateMicUI();
  document.getElementById('myMicMuted').style.display=micOn?'none':'inline';
  const pm=document.getElementById('pm-mic');
  if(pm)pm.className=micOn?'picon ok fa-solid fa-microphone':'picon muted fa-solid fa-microphone-slash';
  toast(micOn?'🎙️ Microphone activé':'🔇 Microphone désactivé');
}
function updateMicUI(){
  document.getElementById('micCircle').className='ctrl-circle '+(micOn?'on':'off');
  document.getElementById('micIcon').className=micOn?'fa-solid fa-microphone':'fa-solid fa-microphone-slash';
  document.getElementById('micLabel').textContent=micOn?'Micro':'Muet';
}

function toggleCam(){
  camOn=!camOn;
  if(stream)stream.getVideoTracks().forEach(t=>t.enabled=camOn);
  document.getElementById('myCamOff').classList.toggle('show',!camOn);
  updateCamUI();
  const pm=document.getElementById('pm-cam');
  if(pm)pm.className=camOn?'picon ok fa-solid fa-video':'picon muted fa-solid fa-video-slash';
  toast(camOn?'📹 Caméra activée':'📷 Caméra désactivée');
}
function updateCamUI(){
  document.getElementById('camCircle').className='ctrl-circle '+(camOn?'on':'off');
  document.getElementById('camIcon').className=camOn?'fa-solid fa-video':'fa-solid fa-video-slash';
  document.getElementById('camLabel').textContent=camOn?'Caméra':'Cam. off';
}

async function toggleScreen(){
  if(!screenOn){
    try{
      screenStream=await navigator.mediaDevices.getDisplayMedia({video:{cursor:'always'},audio:false});
      const v=document.getElementById('myVideo');
      v.srcObject=screenStream;v.classList.add('screen');
      screenOn=true;
      document.getElementById('screenCircle').className='ctrl-circle active-screen';
      document.getElementById('screenLabel').textContent='Arrêter';
      document.getElementById('screenBanner').classList.add('show');
      toast('🖥️ Partage d\'écran activé');
      screenStream.getVideoTracks()[0].onended=()=>stopScreen();
    }catch(e){toast('❌ Partage annulé');}
  }else{stopScreen();}
}
function stopScreen(){
  if(screenStream){screenStream.getTracks().forEach(t=>t.stop());screenStream=null;}
  const v=document.getElementById('myVideo');
  v.classList.remove('screen');
  if(stream&&camOn)v.srcObject=stream;else v.srcObject=null;
  screenOn=false;
  document.getElementById('screenCircle').className='ctrl-circle neutral';
  document.getElementById('screenLabel').textContent='Partager';
  document.getElementById('screenBanner').classList.remove('show');
  toast('🖥️ Partage arrêté');
}

function togglePanel(tab){
  if(panelOpen&&activeTab===tab){
    document.getElementById('sidePanel').classList.add('hidden');
    panelOpen=false;activeTab='';
  }else{
    document.getElementById('sidePanel').classList.remove('hidden');
    panelOpen=true;showTab(tab);
  }
}
function showTab(name){
  activeTab=name;
  ['participants','agenda','invite'].forEach(t=>{
    document.getElementById('tab-'+t).style.display='none';
    document.getElementById('ptab-'+t).classList.remove('active');
  });
  document.getElementById('tab-'+name).style.display='block';
  document.getElementById('ptab-'+name).classList.add('active');
  if(!panelOpen){document.getElementById('sidePanel').classList.remove('hidden');panelOpen=true;}
}

function copyLink(){
  const link=document.getElementById('inviteLink').textContent;
  navigator.clipboard.writeText(link).catch(()=>{});
  const btn=document.getElementById('copyBtn');
  btn.textContent='✓ Copié !';btn.classList.add('done');
  toast('🔗 Lien copié !');
  setTimeout(()=>{btn.textContent='Copier';btn.classList.remove('done');},2500);
}
function sendInvite(){
  const email=document.getElementById('emailInput').value.trim();
  if(!email){toast('⚠️ Entrez une adresse email');return;}
  toast('📧 Invitation envoyée à '+email);
  document.getElementById('emailInput').value='';
}

function endMeeting(){
  if(confirm('Terminer la réunion et générer le compte rendu ?')){
    clearInterval(timerInterval);
    if(stream)stream.getTracks().forEach(t=>t.stop());
    if(screenStream)screenStream.getTracks().forEach(t=>t.stop());
    // Submit end form
    const form=document.querySelector('form[action*="end"]');
    if(form)form.submit();
    else window.location='{{ route("meetings.index") }}';
  }
}

let toastTimer;
function toast(msg){
  const el=document.getElementById('toast');
  el.textContent=msg;el.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer=setTimeout(()=>el.classList.remove('show'),2800);
}

document.addEventListener('keydown',e=>{
  if(e.target.tagName==='INPUT')return;
  if(e.key==='m'||e.key==='M')toggleMic();
  if(e.key==='v'||e.key==='V')toggleCam();
  if(e.key==='s'||e.key==='S')toggleScreen();
});
</script>
</body>
</html>
