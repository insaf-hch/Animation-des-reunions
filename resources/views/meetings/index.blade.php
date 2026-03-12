@extends('layouts.app')
@section('title','Réunions')
@section('styles')
<style>
.page-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.page-title{font-size:20px;font-weight:800;color:var(--text);}
.page-title span{color:var(--primary);}
.filters{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.filter-btn{padding:6px 14px;border-radius:8px;font-size:12px;font-weight:500;border:1.5px solid var(--border);background:var(--surface-2);color:var(--text-sub);cursor:pointer;transition:all .15s;}
.filter-btn.active,.filter-btn:hover{border-color:var(--primary);background:var(--primary-light);color:var(--primary);}

.meetings-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:14px;}
.m-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);padding:18px;box-shadow:var(--shadow-sm);transition:all .2s;position:relative;overflow:hidden;}
.m-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px);border-color:var(--primary);}
.m-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;}
.m-card.today::before{background:linear-gradient(90deg,#16A34A,#0A7EA4);}
.m-card.urgent::before{background:linear-gradient(90deg,#D97706,#DC2626);}
.m-card.upcoming::before{background:linear-gradient(90deg,#0A7EA4,#16A34A);}
.m-card.done::before{background:var(--border);}

.m-card-head{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px;gap:8px;}
.m-card-title{font-size:14px;font-weight:700;color:var(--text);line-height:1.3;}
.m-card-meta{display:flex;flex-direction:column;gap:5px;margin-bottom:12px;}
.m-meta-row{display:flex;align-items:center;gap:7px;font-size:12px;color:var(--text-sub);}
.m-meta-row i{width:14px;text-align:center;color:var(--text-hint);}
.m-card-footer{display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:1px solid var(--border);}
.m-avatars{display:flex;}
.m-av{width:24px;height:24px;border-radius:50%;border:2px solid var(--surface);display:flex;align-items:center;justify-content:center;font-size:8px;font-weight:700;color:#fff;margin-left:-5px;}
.m-av:first-child{margin-left:0;}
.m-actions{display:flex;gap:6px;}
.m-btn{padding:5px 12px;border-radius:7px;font-size:11px;font-weight:600;border:none;cursor:pointer;transition:all .15s;display:flex;align-items:center;gap:4px;text-decoration:none;}
.m-btn-start{background:linear-gradient(135deg,#0A7EA4,#16A34A);color:#fff;}
.m-btn-start:hover{opacity:.85;}
.m-btn-edit{background:var(--surface-2);color:var(--text-sub);border:1px solid var(--border);}
.m-btn-edit:hover{border-color:var(--primary);color:var(--primary);}
.m-btn-del{background:var(--danger-light);color:var(--danger);border:1px solid rgba(220,38,38,.2);}
.m-btn-del:hover{opacity:.8;}

.empty-state{text-align:center;padding:60px 20px;color:var(--text-hint);}
.empty-state i{font-size:48px;margin-bottom:16px;display:block;color:var(--border-2);}
.empty-state h3{font-size:16px;font-weight:600;color:var(--text-sub);margin-bottom:8px;}
.empty-state p{font-size:13px;margin-bottom:20px;}

@media(max-width:640px){.meetings-grid{grid-template-columns:1fr;}.page-head{flex-direction:column;align-items:flex-start;}}
</style>
@endsection
@section('content')
<div class="page-head">
  <div>
    <div class="page-title">📅 Mes <span>Réunions</span></div>
    <div style="font-size:12px;color:var(--text-hint);margin-top:2px;">{{ $meetings->total() }} réunion(s) au total</div>
  </div>
  <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
    <div class="filters">
      <button class="filter-btn {{ request('statut','') === '' ? 'active' : '' }}" onclick="filter('')">Toutes</button>
      <button class="filter-btn {{ request('statut') === 'A venir' ? 'active' : '' }}" onclick="filter('A venir')">À venir</button>
      <button class="filter-btn {{ request('statut') === 'En cours' ? 'active' : '' }}" onclick="filter('En cours')">En cours</button>
      <button class="filter-btn {{ request('statut') === 'Terminee' ? 'active' : '' }}" onclick="filter('Terminee')">Terminées</button>
    </div>
    <a href="{{ route('meetings.create') }}" class="btn btn-primary btn-sm">
      <i class="fa-solid fa-plus"></i> Nouvelle réunion
    </a>
  </div>
</div>

@if($meetings->isEmpty())
<div class="empty-state">
  <i class="fa-solid fa-calendar-xmark"></i>
  <h3>Aucune réunion trouvée</h3>
  <p>Commencez par créer votre première réunion.</p>
  <a href="{{ route('meetings.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Créer une réunion</a>
</div>
@else
<div class="meetings-grid">
  @foreach($meetings as $meeting)
  @php
    $mDate = \Carbon\Carbon::parse($meeting->date_reunion);
    $isToday = $mDate->isToday();
    $isUrgent = $meeting->priorite === 'Urgent';
    $isDone = $meeting->statut === 'Terminee';
    $cardClass = $isToday ? 'today' : ($isDone ? 'done' : ($isUrgent ? 'urgent' : 'upcoming'));
    $colors = ['#0A7EA4','#16A34A','#7C3AED','#D97706','#DC2626','#0891B2'];
  @endphp
  <div class="m-card {{ $cardClass }}">
    <div class="m-card-head">
      <div class="m-card-title">{{ $meeting->titre }}</div>
      @if($isToday)
        <span class="badge badge-green">Aujourd'hui</span>
      @elseif($isDone)
        <span class="badge badge-gray">Terminée</span>
      @elseif($isUrgent)
        <span class="badge badge-warn">Urgent</span>
      @else
        <span class="badge badge-blue">À venir</span>
      @endif
    </div>
    <div class="m-card-meta">
      <div class="m-meta-row"><i class="fa-solid fa-calendar"></i> {{ $mDate->translatedFormat('l d F Y') }}</div>
      <div class="m-meta-row"><i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($meeting->heure_debut)->format('H:i') }} · {{ $meeting->duree }}min</div>
      <div class="m-meta-row"><i class="fa-solid fa-location-dot"></i> {{ $meeting->lieu }}</div>
      @if($meeting->lien_reunion)
      <div class="m-meta-row"><i class="fa-solid fa-video"></i> <a href="{{ $meeting->lien_reunion }}" target="_blank" style="color:var(--primary);font-size:11px;">Rejoindre en ligne</a></div>
      @endif
    </div>
    <div class="m-card-footer">
      <div class="m-avatars">
        @foreach($meeting->participants->take(4) as $i => $p)
          <div class="m-av" style="background:{{ $colors[$i % count($colors)] }};">
            {{ strtoupper(substr($p->user->name ?? '?', 0, 2)) }}
          </div>
        @endforeach
        @if($meeting->participants->count() > 4)
          <div class="m-av" style="background:#475569;">+{{ $meeting->participants->count() - 4 }}</div>
        @endif
      </div>
      <div class="m-actions">
        @if(!$isDone)
        <a href="{{ route('meetings.room', $meeting->id) }}" class="m-btn m-btn-start">
          <i class="fa-solid fa-play"></i> Démarrer
        </a>
        @endif
        <a href="{{ route('meetings.edit', $meeting->id) }}" class="m-btn m-btn-edit">
          <i class="fa-solid fa-pen"></i>
        </a>
        <form method="POST" action="{{ route('meetings.destroy', $meeting->id) }}" onsubmit="return confirm('Supprimer cette réunion ?')">
          @csrf @method('DELETE')
          <button type="submit" class="m-btn m-btn-del"><i class="fa-solid fa-trash"></i></button>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>
<div style="margin-top:16px;">{{ $meetings->links() }}</div>
@endif
@endsection
@section('scripts')
<script>
function filter(statut){
  const url = new URL(window.location);
  if(statut) url.searchParams.set('statut', statut);
  else url.searchParams.delete('statut');
  window.location = url;
}
</script>
@endsection
