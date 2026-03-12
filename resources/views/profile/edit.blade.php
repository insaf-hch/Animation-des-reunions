@extends('layouts.app')
@section('title', 'Paramètres')

@section('content')
<div style="max-width:800px;margin:0 auto;padding:20px 24px;">
        <div class="sec-head" style="margin-bottom:20px;">
            <h1 class="sec-title" style="font-size:18px;">
                <i class="fa-solid fa-gear"></i>
                Paramètres du profil
            </h1>
        </div>

        <!-- Profile Info Card -->
        <div class="card" style="margin-bottom:20px;padding:24px;">
            <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;border-bottom:1px solid var(--border);padding-bottom:20px;">
                <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;font-size:32px;font-weight:700;color:#fff;">
                    {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                </div>
                <div>
                    <div style="font-size:16px;font-weight:600;color:var(--text);">{{ Auth::user()->name }}</div>
                    <div style="font-size:13px;color:var(--text-hint);margin-top:4px;">{{ Auth::user()->email }}</div>
                    <div style="font-size:12px;color:var(--text-hint);margin-top:4px;font-weight:500;">{{ Auth::user()->role }}</div>
                </div>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success" style="margin-bottom:20px;">
                    <i class="fa-solid fa-check-circle"></i>
                    Profil mis à jour avec succès.
                </div>
            @endif

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name')<div style="color:var(--danger);font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email')<div style="color:var(--danger);font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
                </div>

                <div style="display:flex;gap:10px;align-items:center;margin-top:20px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password Card -->
        <div class="card" style="margin-bottom:20px;padding:24px;">
            <div style="margin-bottom:20px;border-bottom:1px solid var(--border);padding-bottom:16px;">
                <h3 style="font-size:15px;font-weight:600;color:var(--text);display:flex;align-items:center;gap:8px;">
                    <i class="fa-solid fa-lock"></i>
                    Changer le mot de passe
                </h3>
                <p style="font-size:12px;color:var(--text-hint);margin-top:4px;">Assurez-vous d'utiliser un mot de passe long et aléatoire pour rester en sécurité.</p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success" style="margin-bottom:20px;">
                    <i class="fa-solid fa-check-circle"></i>
                    Mot de passe changé avec succès.
                </div>
            @endif

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="form-label">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control" required>
                    @error('updatePassword.current_password')<div style="color:var(--danger);font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('updatePassword.password')<div style="color:var(--danger);font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                    @error('updatePassword.password_confirmation')<div style="color:var(--danger);font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Mettre à jour
                </button>
            </form>
        </div>

        <!-- Delete Account Card -->
        <div class="card" style="padding:24px;border:1px solid var(--danger-light);">
            <div style="margin-bottom:20px;border-bottom:1px solid var(--border);padding-bottom:16px;">
                <h3 style="font-size:15px;font-weight:600;color:var(--danger);display:flex;align-items:center;gap:8px;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Supprimer le compte
                </h3>
                <p style="font-size:12px;color:var(--text-hint);margin-top:4px;">Une fois votre compte supprimé, il n'y a pas de retour. Cette action est irréversible.</p>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous certain de vouloir supprimer votre compte ? Cette action est irréversible.');">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label class="form-label">Entrez votre mot de passe pour confirmer</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('userDeletion.password')<div style="color:var(--danger);font-size:12px;margin-top:5px;">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i> Supprimer le compte
                </button>
            </form>
        </div>
</div>
@endsection
