@extends('layouts.app')
@section('title', isset($meeting) ? 'Modifier la réunion' : 'Nouvelle réunion')
@section('styles')
<style>
.form-card{background:var(--surface);border-radius:var(--r-xl);border:1px solid var(--border);box-shadow:var(--shadow-md);overflow:hidden;max-width:760px;margin:0 auto;}
.form-header{background:linear-gradient(135deg,#0A2540,#0A7EA4);padding:24px 28px;}
.form-header h2{font-size:18px;font-weight:700;color:#fff;}
.form-header p{font-size:12px;color:rgba(255,255,255,.7);margin-top:3px;}
.form-body{padding:28px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.form-grid .full{grid-column:1/-1;}
.section-divider{font-size:11px;font-weight:700;color:var(--text-hint);text-transform:uppercase;letter-spacing:.8px;margin:20px 0 12px;padding-bottom:8px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:8px;}
.form-actions{display:flex;justify-content:flex-end;gap:10px;padding-top:20px;border-top:1px solid var(--border);margin-top:4px;}
.participants-section{margin-top:4px;}
.user-checkbox{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:9px;border:1.5px solid var(--border);cursor:pointer;transition:all .15s;margin-bottom:7px;}
.user-checkbox:hover{border-color:var(--primary);background:var(--primary-light);}
.user-checkbox input[type="checkbox"]{accent-color:var(--primary);width:15px;height:15px;flex-shrink:0;}
.user-checkbox.checked{border-color:var(--primary);background:var(--primary-light);}
.uc-av{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;flex-shrink:0;}
.uc-name{font-size:13px;font-weight:500;color:var(--text);}
.uc-role{font-size:11px;color:var(--text-hint);}
.role-select{margin-left:auto;}
.role-select select{padding:4px 8px;border-radius:6px;border:1px solid var(--border);background:var(--surface);color:var(--text);font-family:inherit;font-size:11px;outline:none;}
.lien-hint{font-size:11px;color:var(--text-hint);margin-top:4px;display:flex;align-items:center;gap:4px;}

@media(max-width:640px){.form-grid{grid-template-columns:1fr;}.form-grid .full{grid-column:1;}}
</style>
@endsection
@section('content')
<div style="max-width:760px;margin:0 auto;">
  <div style="margin-bottom:16px;">
    <a href="{{ route('meetings.index') }}" style="font-size:13px;color:var(--text-sub);display:flex;align-items:center;gap:6px;">
      <i class="fa-solid fa-arrow-left"></i> Retour aux réunions
    </a>
  </div>

  <div class="form-card">
    <div class="form-header">
      <h2>{{ isset($meeting) ? '✏️ Modifier la réunion' : '📅 Nouvelle réunion' }}</h2>
      <p>{{ isset($meeting) ? 'Modifiez les informations de la réunion' : 'Remplissez les informations pour créer une nouvelle réunion' }}</p>
    </div>
    <div class="form-body">
      <form method="POST" action="{{ isset($meeting) ? route('meetings.update', $meeting->id) : route('meetings.store') }}">
        @csrf
        @if(isset($meeting)) @method('PUT') @endif

        <div class="section-divider"><i class="fa-solid fa-circle-info" style="color:var(--primary);"></i> Informations générales</div>
        <div class="form-grid">
          <div class="form-group full">
            <label class="form-label">Titre de la réunion *</label>
            <input type="text" name="titre" class="form-control" placeholder="Ex: Réunion de lancement — Projet Alpha" value="{{ old('titre', $meeting->titre ?? '') }}" required/>
          </div>
          <div class="form-group">
            <label class="form-label">Type de réunion</label>
            <select name="type" class="form-control">
              @foreach(['Réunion de lancement','Réunion de suivi','Revue de sprint','Comité de pilotage','Brainstorming','Autre'] as $t)
                <option value="{{ $t }}" {{ old('type', $meeting->type ?? '') === $t ? 'selected' : '' }}>{{ $t }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Priorité</label>
            <select name="priorite" class="form-control">
              @foreach(['Normal','Important','Urgent'] as $p)
                <option value="{{ $p }}" {{ old('priorite', $meeting->priorite ?? 'Normal') === $p ? 'selected' : '' }}>{{ $p }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="section-divider"><i class="fa-solid fa-clock" style="color:var(--primary);"></i> Date & Horaires</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Date *</label>
            <input type="date" name="date_reunion" class="form-control" value="{{ old('date_reunion', isset($meeting) ? \Carbon\Carbon::parse($meeting->date_reunion)->format('Y-m-d') : '') }}" required/>
          </div>
          <div class="form-group">
            <label class="form-label">Heure de début *</label>
            <input type="time" name="heure_debut" class="form-control" value="{{ old('heure_debut', isset($meeting) ? \Carbon\Carbon::parse($meeting->heure_debut)->format('H:i') : '') }}" required/>
          </div>
          <div class="form-group">
            <label class="form-label">Durée (minutes) *</label>
            <input type="number" name="duree" class="form-control" placeholder="60" min="15" max="480" value="{{ old('duree', $meeting->duree ?? 60) }}" required/>
          </div>
          <div class="form-group">
            <label class="form-label">Lieu / Salle</label>
            <input type="text" name="lieu" class="form-control" placeholder="Salle A, Zoom, Teams..." value="{{ old('lieu', $meeting->lieu ?? '') }}"/>
          </div>
        </div>

        <div class="section-divider"><i class="fa-solid fa-video" style="color:var(--primary);"></i> Réunion en ligne (optionnel)</div>
        <div class="form-group">
          <label class="form-label">Lien de réunion</label>
          <input type="url" name="lien_reunion" class="form-control" placeholder="https://teams.microsoft.com/... ou https://zoom.us/..." value="{{ old('lien_reunion', $meeting->lien_reunion ?? '') }}"/>
          <div class="lien-hint">
            <i class="fa-brands fa-microsoft" style="color:#0A7EA4;"></i> Teams &nbsp;|&nbsp;
            <i class="fa-solid fa-video" style="color:#2D8CFF;"></i> Zoom &nbsp;|&nbsp;
            <i class="fa-brands fa-google" style="color:#EA4335;"></i> Meet
          </div>
        </div>

        <div class="section-divider"><i class="fa-solid fa-users" style="color:var(--primary);"></i> Participants</div>
        <div class="participants-section">
          @foreach($users as $i => $user)
          @php
            $colors = ['#0A7EA4','#16A34A','#7C3AED','#D97706','#DC2626','#0891B2'];
            $isChecked = isset($meeting) ? $meeting->participants->contains('user_id', $user->id) : false;
            $existingRole = isset($meeting) ? $meeting->participants->where('user_id', $user->id)->first()?->role_reunion : 'Participant';
          @endphp
          <div class="user-checkbox {{ $isChecked ? 'checked' : '' }}" onclick="toggleParticipant(this)">
            <input type="checkbox" name="participants[]" value="{{ $user->id }}" {{ $isChecked ? 'checked' : '' }}/>
            <div class="uc-av" style="background:{{ $colors[$i % count($colors)] }};">{{ strtoupper(substr($user->name,0,2)) }}</div>
            <div style="flex:1;">
              <div class="uc-name">{{ $user->name }} @if($user->id === Auth::id()) <span style="font-size:9px;background:var(--primary-light);color:var(--primary);padding:1px 6px;border-radius:4px;">Vous</span> @endif</div>
              <div class="uc-role">{{ $user->role }}</div>
            </div>
            <div class="role-select">
              <select name="roles[{{ $user->id }}]" onclick="event.stopPropagation()">
                @foreach(['Animateur','Rapporteur','Participant'] as $r)
                  <option value="{{ $r }}" {{ ($existingRole ?? 'Participant') === $r ? 'selected' : '' }}>{{ $r }}</option>
                @endforeach
              </select>
            </div>
          </div>
          @endforeach
        </div>

        <div class="form-actions">
          <a href="{{ route('meetings.index') }}" class="btn btn-secondary">Annuler</a>
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-{{ isset($meeting) ? 'floppy-disk' : 'plus' }}"></i>
            {{ isset($meeting) ? 'Enregistrer' : 'Créer la réunion' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
function toggleParticipant(el){
  const cb = el.querySelector('input[type="checkbox"]');
  cb.checked = !cb.checked;
  el.classList.toggle('checked', cb.checked);
}
</script>
@endsection
