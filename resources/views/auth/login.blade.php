<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>SmartMeeting — Connexion</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{--primary:#0A7EA4;--accent:#16A34A;--bg:#F8FAFB;--surface:#FFFFFF;--border:#E2E8F0;--text:#0F172A;--text-sub:#475569;--text-hint:#94A3B8;font-family:'Outfit',sans-serif;}
body{background:var(--bg);min-height:100vh;display:flex;}
.page{display:flex;width:100%;min-height:100vh;}

.brand-panel{flex:1;background:linear-gradient(150deg,#0A2540 0%,#0A7EA4 55%,#16A34A 100%);display:flex;flex-direction:column;justify-content:center;align-items:center;padding:60px 52px;position:relative;overflow:hidden;}
.brand-panel::before{content:'';position:absolute;width:520px;height:520px;background:rgba(255,255,255,.05);border-radius:50%;top:-160px;right:-160px;}
.brand-panel::after{content:'';position:absolute;width:320px;height:320px;background:rgba(255,255,255,.04);border-radius:50%;bottom:-90px;left:-90px;}
.brand-content{position:relative;z-index:1;max-width:420px;width:100%;}
.brand-logo{display:flex;align-items:center;gap:12px;margin-bottom:44px;}
.brand-icon-box{width:50px;height:50px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);border-radius:13px;display:flex;align-items:center;justify-content:center;}
.brand-icon-box i{font-size:22px;color:#fff;}
.brand-name{font-size:24px;font-weight:700;color:#fff;}
.brand-headline{font-size:30px;font-weight:700;color:#fff;line-height:1.25;letter-spacing:-.4px;margin-bottom:14px;}
.brand-sub{font-size:14px;color:rgba(255,255,255,.72);line-height:1.65;margin-bottom:40px;}
.feature-list{display:flex;flex-direction:column;gap:10px;}
.feat{display:flex;align-items:flex-start;gap:13px;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.13);border-radius:10px;padding:12px 14px;}
.feat i{font-size:14px;color:rgba(255,255,255,.9);margin-top:1px;flex-shrink:0;}
.feat-title{font-size:13px;font-weight:600;color:#fff;margin-bottom:1px;}
.feat-desc{font-size:11px;color:rgba(255,255,255,.55);}
.stats-row{display:flex;margin-top:32px;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.13);border-radius:10px;overflow:hidden;}
.stat{flex:1;padding:14px 10px;text-align:center;border-right:1px solid rgba(255,255,255,.1);}
.stat:last-child{border-right:none;}
.stat-n{font-size:21px;font-weight:700;color:#fff;}
.stat-l{font-size:11px;color:rgba(255,255,255,.52);margin-top:2px;}

.form-panel{width:456px;flex-shrink:0;background:#fff;display:flex;flex-direction:column;justify-content:center;padding:48px 44px;box-shadow:-6px 0 28px rgba(0,0,0,.07);animation:slideIn .3s ease;}
@keyframes slideIn{from{opacity:0;transform:translateX(12px);}to{opacity:1;transform:translateX(0);}}

.f-logo{display:flex;align-items:center;gap:9px;margin-bottom:28px;}
.f-logo-icon{width:34px;height:34px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;}
.f-logo-icon i{font-size:15px;color:#fff;}
.f-logo-name{font-size:17px;font-weight:700;color:var(--text);}
.f-logo-name span{color:var(--accent);}
.f-heading{font-size:22px;font-weight:700;color:var(--text);margin-bottom:5px;}
.f-desc{font-size:14px;color:var(--text-sub);margin-bottom:24px;line-height:1.5;}

.tabs{display:flex;border-bottom:2px solid var(--border);margin-bottom:22px;}
.t-btn{flex:1;padding:9px 6px;text-align:center;font-family:inherit;font-size:13px;font-weight:500;color:var(--text-sub);background:none;border:none;border-bottom:2px solid transparent;margin-bottom:-2px;cursor:pointer;transition:color .15s,border-color .15s;}
.t-btn.active{color:var(--primary);border-bottom-color:var(--primary);}

.f-group{margin-bottom:14px;}
.f-label{display:block;font-size:13px;font-weight:500;color:var(--text);margin-bottom:5px;}
.i-wrap{position:relative;}
.i-icon{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:var(--text-hint);font-size:13px;pointer-events:none;}
.f-input{width:100%;border:1.5px solid var(--border);border-radius:6px;padding:10px 11px 10px 34px;font-family:inherit;font-size:14px;color:var(--text);background:#fff;outline:none;transition:border-color .15s,box-shadow .15s;}
.f-input:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(10,126,164,.13);}
.f-input::placeholder{color:var(--text-hint);}
.i-eye{position:absolute;right:11px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-hint);font-size:13px;cursor:pointer;}
.i-eye:hover{color:var(--text-sub);}

.f-options{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
.chk{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--text-sub);cursor:pointer;}
.chk input{accent-color:var(--primary);}
.f-link{font-size:13px;color:var(--primary);text-decoration:none;font-weight:500;}

.btn-main{width:100%;padding:11px;background:linear-gradient(135deg,#0A7EA4,#16A34A);color:#fff;border:none;border-radius:6px;font-family:inherit;font-size:14px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:opacity .15s;margin-bottom:16px;box-shadow:0 4px 14px rgba(10,126,164,.25);position:relative;overflow:hidden;}
.btn-main:hover{opacity:.9;}
.btn-main.loading .lbl{opacity:0;}
.btn-main.loading::after{content:'';position:absolute;width:17px;height:17px;border:2px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:spin .7s linear infinite;}
@keyframes spin{to{transform:rotate(360deg);}}

.or-row{display:flex;align-items:center;gap:10px;margin-bottom:12px;}
.or-line{flex:1;height:1px;background:var(--border);}
.or-txt{font-size:12px;color:var(--text-hint);}

.social-row{display:flex;gap:9px;margin-bottom:24px;}
.btn-soc{flex:1;padding:9px;background:#fff;border:1.5px solid var(--border);border-radius:6px;display:flex;align-items:center;justify-content:center;gap:7px;font-family:inherit;font-size:13px;color:var(--text-sub);cursor:pointer;transition:border-color .15s,background .15s;}
.btn-soc:hover{border-color:var(--primary);background:#E0F4FA;}

.f-footer{text-align:center;font-size:12px;color:var(--text-hint);border-top:1px solid var(--border);padding-top:14px;}
.f-footer a{color:var(--primary);}
.panel{display:none;}
.panel.active{display:block;}

.error-msg{background:#FEE2E2;color:#DC2626;border:1px solid rgba(220,38,38,.2);border-radius:7px;padding:9px 12px;font-size:12px;margin-bottom:14px;display:flex;align-items:center;gap:8px;}

@media(max-width:860px){.brand-panel{display:none;}.form-panel{width:100%;box-shadow:none;}}
</style>
</head>
<body>
<div class="page">
  <div class="brand-panel">
    <div class="brand-content">
      <div class="brand-logo">
        <div class="brand-icon-box"><i class="fa-solid fa-calendar-check"></i></div>
        <div class="brand-name">SmartMeeting</div>
      </div>
      <div class="brand-headline">Réunions de projet,<br>gérées intelligemment</div>
      <div class="brand-sub">Planifiez, animez et suivez vos réunions d'équipe avec des outils professionnels dans une seule plateforme.</div>
      <div class="feature-list">
        <div class="feat"><i class="fa-solid fa-calendar-days"></i><div><div class="feat-title">Planification simplifiée</div><div class="feat-desc">Créez et organisez vos réunions en quelques clics</div></div></div>
        <div class="feat"><i class="fa-solid fa-video"></i><div><div class="feat-title">Animation en temps réel</div><div class="feat-desc">Caméra, micro et partage d'écran intégrés</div></div></div>
        <div class="feat"><i class="fa-solid fa-file-lines"></i><div><div class="feat-title">Comptes rendus automatiques</div><div class="feat-desc">Génération et partage instantané du CR en PDF</div></div></div>
        <div class="feat"><i class="fa-solid fa-chart-line"></i><div><div class="feat-title">Suivi des tâches & reporting</div><div class="feat-desc">Tableau de bord centralisé pour toute l'équipe</div></div></div>
      </div>
      <div class="stats-row">
        <div class="stat"><div class="stat-n">3x</div><div class="stat-l">Plus productif</div></div>
        <div class="stat"><div class="stat-n">-40%</div><div class="stat-l">Temps perdu</div></div>
        <div class="stat"><div class="stat-n">98%</div><div class="stat-l">Satisfaction</div></div>
      </div>
    </div>
  </div>

  <div class="form-panel">
    <div class="f-logo">
      <div class="f-logo-icon"><i class="fa-solid fa-calendar-check"></i></div>
      <div class="f-logo-name">Smart<span>Meeting</span></div>
    </div>
    <div class="f-heading">Bon retour 👋</div>
    <div class="f-desc">Connectez-vous pour accéder à votre espace</div>

    <div class="tabs">
      <button class="t-btn active" onclick="switchTab('login',this)">Connexion</button>
      <button class="t-btn" onclick="switchTab('register',this)">Créer un compte</button>
    </div>

    <!-- LOGIN -->
    <div id="panel-login" class="panel active">
      @if($errors->any() && old('_form') === 'login')
        <div class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="_form" value="login"/>
        <div class="f-group">
          <label class="f-label">Adresse e-mail</label>
          <div class="i-wrap">
            <i class="fa-solid fa-envelope i-icon"></i>
            <input type="email" name="email" class="f-input" placeholder="prenom.nom@exemple.com" value="{{ old('email') }}" required/>
          </div>
        </div>
        <div class="f-group">
          <label class="f-label">Mot de passe</label>
          <div class="i-wrap">
            <i class="fa-solid fa-lock i-icon"></i>
            <input type="password" id="p1" name="password" class="f-input" placeholder="Votre mot de passe" required/>
            <button type="button" class="i-eye" onclick="toggleP('p1',this)"><i class="fa-solid fa-eye"></i></button>
          </div>
        </div>
        <div class="f-options">
          <label class="chk"><input type="checkbox" name="remember"/> Rester connecté</label>
          <a href="#" class="f-link">Mot de passe oublié ?</a>
        </div>
        <button type="submit" class="btn-main">
          <span class="lbl"><i class="fa-solid fa-right-to-bracket"></i> Se connecter</span>
        </button>
      </form>
      <div class="or-row"><div class="or-line"></div><span class="or-txt">Ou continuer avec</span><div class="or-line"></div></div>
      <div class="social-row">
        <button class="btn-soc"><svg width="15" height="15" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg> Google</button>
        <button class="btn-soc"><svg width="15" height="15" viewBox="0 0 23 23"><path fill="#f3f3f3" d="M0 0h23v23H0z"/><path fill="#f35325" d="M1 1h10v10H1z"/><path fill="#81bc06" d="M12 1h10v10H12z"/><path fill="#05a6f0" d="M1 12h10v10H1z"/><path fill="#ffba08" d="M12 12h10v10H12z"/></svg> Microsoft</button>
      </div>
    </div>

    <!-- REGISTER -->
    <div id="panel-register" class="panel">
      @if($errors->any() && old('_form') === 'register')
        <div class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="_form" value="register"/>
        <div class="f-group">
          <label class="f-label">Nom complet</label>
          <div class="i-wrap">
            <i class="fa-solid fa-user i-icon"></i>
            <input type="text" name="name" class="f-input" placeholder="Prénom Nom" value="{{ old('name') }}" required/>
          </div>
        </div>
        <div class="f-group">
          <label class="f-label">Adresse e-mail</label>
          <div class="i-wrap">
            <i class="fa-solid fa-envelope i-icon"></i>
            <input type="email" name="email" class="f-input" placeholder="prenom.nom@exemple.com" value="{{ old('email') }}" required/>
          </div>
        </div>
        <div class="f-group">
          <label class="f-label">Mot de passe</label>
          <div class="i-wrap">
            <i class="fa-solid fa-lock i-icon"></i>
            <input type="password" id="p2" name="password" class="f-input" placeholder="Min. 8 caractères" required/>
            <button type="button" class="i-eye" onclick="toggleP('p2',this)"><i class="fa-solid fa-eye"></i></button>
          </div>
        </div>
        <div class="f-group">
          <label class="f-label">Confirmer le mot de passe</label>
          <div class="i-wrap">
            <i class="fa-solid fa-lock i-icon"></i>
            <input type="password" name="password_confirmation" class="f-input" placeholder="Répétez le mot de passe" required/>
          </div>
        </div>
        <div class="f-group" style="margin-bottom:18px;">
          <label class="f-label">Rôle</label>
          <div class="i-wrap">
            <i class="fa-solid fa-briefcase i-icon"></i>
            <select name="role" class="f-input" style="cursor:pointer;appearance:none;">
              <option value="Membre" {{ old('role')==="Membre"?'selected':'' }}>Membre</option>
              <option value="Chef de projet" {{ old('role')==='Chef de projet'?'selected':'' }}>Chef de projet</option>
              <option value="Directeur" {{ old('role')==='Directeur'?'selected':'' }}>Directeur</option>
              <option value="Consultant" {{ old('role')==='Consultant'?'selected':'' }}>Consultant</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn-main">
          <span class="lbl"><i class="fa-solid fa-user-plus"></i> Créer mon compte</span>
        </button>
      </form>
    </div>

    <div class="f-footer">
      En vous connectant, vous acceptez nos <a href="#">Conditions d'utilisation</a> et notre <a href="#">Politique de confidentialité</a>.
    </div>
  </div>
</div>
<script>
function switchTab(tab,el){
  document.querySelectorAll('.t-btn').forEach(b=>b.classList.remove('active'));
  document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('panel-'+tab).classList.add('active');
}
function toggleP(id,btn){
  const inp=document.getElementById(id);
  const ic=btn.querySelector('i');
  inp.type=inp.type==='password'?'text':'password';
  ic.className=inp.type==='password'?'fa-solid fa-eye':'fa-solid fa-eye-slash';
}
@if(old('_form')==='register')
switchTab('register', document.querySelectorAll('.t-btn')[1]);
@endif
</script>
</body>
</html>
