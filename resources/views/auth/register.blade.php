<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SmartMeeting — Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #F8FAFB; min-height: 100vh; display: flex; }
        .page { display: flex; width: 100%; min-height: 100vh; }
        .brand-panel { flex: 1; background: linear-gradient(150deg, #0A2540 0%, #0A7EA4 55%, #16A34A 100%); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px 52px; position: relative; overflow: hidden; }
        .brand-panel::before { content: ''; position: absolute; width: 520px; height: 520px; background: rgba(255,255,255,.05); border-radius: 50%; top: -160px; right: -160px; }
        .brand-content { position: relative; z-index: 1; max-width: 400px; width: 100%; }
        .brand-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 36px; }
        .brand-icon { width: 50px; height: 50px; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2); border-radius: 13px; display: flex; align-items: center; justify-content: center; }
        .brand-icon i { font-size: 22px; color: #fff; }
        .brand-name { font-size: 24px; font-weight: 700; color: #fff; }
        .brand-headline { font-size: 28px; font-weight: 700; color: #fff; line-height: 1.25; margin-bottom: 12px; }
        .brand-sub { font-size: 14px; color: rgba(255,255,255,.72); line-height: 1.65; margin-bottom: 32px; }
        .steps { display: flex; flex-direction: column; gap: 14px; }
        .step { display: flex; align-items: center; gap: 14px; }
        .step-num { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #0A7EA4, #16A34A); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0; }
        .step-text { font-size: 13px; color: rgba(255,255,255,.8); }

        .form-panel { width: 480px; flex-shrink: 0; background: #fff; display: flex; flex-direction: column; justify-content: center; padding: 40px 44px; box-shadow: -6px 0 28px rgba(0,0,0,.07); overflow-y: auto; }
        .f-logo { display: flex; align-items: center; gap: 9px; margin-bottom: 24px; }
        .f-logo-icon { width: 34px; height: 34px; background: #0A7EA4; border-radius: 8px; display: flex; align-items: center; justify-content: center; }
        .f-logo-icon i { font-size: 15px; color: #fff; }
        .f-logo-name { font-size: 17px; font-weight: 700; color: #0F172A; }
        .f-logo-name span { color: #16A34A; }
        .f-heading { font-size: 22px; font-weight: 700; color: #0F172A; margin-bottom: 4px; }
        .f-desc { font-size: 14px; color: #475569; margin-bottom: 22px; }
        .f-group { margin-bottom: 13px; }
        .f-label { display: block; font-size: 13px; font-weight: 500; color: #0F172A; margin-bottom: 5px; }
        .i-wrap { position: relative; }
        .i-icon { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: #94A3B8; font-size: 13px; pointer-events: none; }
        .f-input { width: 100%; border: 1.5px solid #E2E8F0; border-radius: 8px; padding: 10px 11px 10px 34px; font-family: inherit; font-size: 14px; color: #0F172A; background: #fff; outline: none; transition: border-color .15s, box-shadow .15s; }
        .f-input:focus { border-color: #0A7EA4; box-shadow: 0 0 0 3px rgba(10,126,164,.12); }
        .f-input::placeholder { color: #94A3B8; }
        .i-eye { position: absolute; right: 11px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94A3B8; font-size: 13px; cursor: pointer; padding: 0; }
        .btn-main { width: 100%; padding: 11px; background: linear-gradient(135deg, #0A7EA4, #16A34A); color: #fff; border: none; border-radius: 8px; font-family: inherit; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: opacity .15s; margin-bottom: 16px; box-shadow: 0 4px 14px rgba(10,126,164,.25); }
        .btn-main:hover { opacity: .9; }
        .f-footer { text-align: center; font-size: 12px; color: #94A3B8; border-top: 1px solid #E2E8F0; padding-top: 14px; }
        .f-footer a { color: #0A7EA4; text-decoration: none; }
        .alert-err { padding: 10px 14px; background: #FEE2E2; color: #DC2626; border-radius: 8px; font-size: 13px; margin-bottom: 14px; border: 1px solid rgba(220,38,38,.2); display: flex; align-items: center; gap: 8px; }
        @media (max-width: 860px) { .brand-panel { display: none; } .form-panel { width: 100%; box-shadow: none; } }
    </style>
</head>
<body>
<div class="page">
    <div class="brand-panel">
        <div class="brand-content">
            <div class="brand-logo">
                <div class="brand-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="brand-name">SmartMeeting</div>
            </div>
            <div class="brand-headline">Rejoignez SmartMeeting</div>
            <div class="brand-sub">Créez votre compte et commencez à gérer vos réunions de façon professionnelle dès aujourd'hui.</div>
            <div class="steps">
                <div class="step"><div class="step-num">1</div><div class="step-text">Créez votre compte en quelques secondes</div></div>
                <div class="step"><div class="step-num">2</div><div class="step-text">Invitez votre équipe et planifiez votre première réunion</div></div>
                <div class="step"><div class="step-num">3</div><div class="step-text">Animez, décidez et générez vos comptes rendus</div></div>
            </div>
        </div>
    </div>

    <div class="form-panel">
        <div class="f-logo">
            <div class="f-logo-icon"><i class="fa-solid fa-calendar-check"></i></div>
            <div class="f-logo-name">Smart<span>Meeting</span></div>
        </div>
        <div class="f-heading">Créer un compte 🚀</div>
        <div class="f-desc">Rejoignez SmartMeeting gratuitement</div>

        @if($errors->any())
            <div class="alert-err"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="f-group">
                <label class="f-label">Nom complet</label>
                <div class="i-wrap">
                    <i class="fa-solid fa-user i-icon"></i>
                    <input type="text" name="name" class="f-input" value="{{ old('name') }}" placeholder="Prénom Nom" required autofocus/>
                </div>
            </div>
            <div class="f-group">
                <label class="f-label">Adresse e-mail</label>
                <div class="i-wrap">
                    <i class="fa-solid fa-envelope i-icon"></i>
                    <input type="email" name="email" class="f-input" value="{{ old('email') }}" placeholder="prenom.nom@entreprise.com" required/>
                </div>
            </div>
            <div class="f-group">
                <label class="f-label">Rôle dans l'équipe</label>
                <div class="i-wrap">
                    <i class="fa-solid fa-briefcase i-icon"></i>
                    <select name="role" class="f-input" style="cursor:pointer; appearance:none;">
                        <option value="" disabled selected>Sélectionner votre rôle</option>
                        <option value="Chef de projet" {{ old('role') === 'Chef de projet' ? 'selected' : '' }}>Chef de projet</option>
                        <option value="Développeur"    {{ old('role') === 'Développeur'    ? 'selected' : '' }}>Développeur</option>
                        <option value="Designer"       {{ old('role') === 'Designer'       ? 'selected' : '' }}>Designer</option>
                        <option value="Analyste"       {{ old('role') === 'Analyste'       ? 'selected' : '' }}>Analyste</option>
                        <option value="Directeur"      {{ old('role') === 'Directeur'      ? 'selected' : '' }}>Directeur</option>
                        <option value="Consultant"     {{ old('role') === 'Consultant'     ? 'selected' : '' }}>Consultant</option>
                        <option value="Membre"         {{ old('role') === 'Membre'         ? 'selected' : '' }}>Membre</option>
                    </select>
                </div>
            </div>
            <div class="f-group">
                <label class="f-label">Mot de passe</label>
                <div class="i-wrap">
                    <i class="fa-solid fa-lock i-icon"></i>
                    <input type="password" id="pwd1" name="password" class="f-input" placeholder="Minimum 8 caractères" required/>
                    <button type="button" class="i-eye" onclick="togglePwd('pwd1', this)"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
            <div class="f-group" style="margin-bottom: 20px;">
                <label class="f-label">Confirmer le mot de passe</label>
                <div class="i-wrap">
                    <i class="fa-solid fa-lock i-icon"></i>
                    <input type="password" id="pwd2" name="password_confirmation" class="f-input" placeholder="Répétez votre mot de passe" required/>
                    <button type="button" class="i-eye" onclick="togglePwd('pwd2', this)"><i class="fa-solid fa-eye"></i></button>
                </div>
            </div>
            <button type="submit" class="btn-main">
                <i class="fa-solid fa-user-plus"></i> Créer mon compte
            </button>
        </form>

        <div class="f-footer">
            Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a><br><br>
            En créant un compte, vous acceptez nos <a href="#">Conditions d'utilisation</a>.
        </div>
    </div>
</div>
<script>
function togglePwd(id, btn) {
    const inp = document.getElementById(id);
    const ic = btn.querySelector('i');
    inp.type = inp.type === 'password' ? 'text' : 'password';
    ic.className = inp.type === 'password' ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash';
}
</script>
</body>
</html>
