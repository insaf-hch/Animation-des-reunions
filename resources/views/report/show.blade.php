@extends('layouts.app')
@section('title','Compte rendu')
@section('content')
<div style="max-width:760px;margin:0 auto;">
  <div style="margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;">
    <a href="{{ route('report.index') }}" style="font-size:13px;color:var(--text-sub);display:flex;align-items:center;gap:6px;"><i class="fa-solid fa-arrow-left"></i> Retour</a>
    <a href="{{ route('report.pdf', $meeting->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-pdf"></i> Télécharger PDF</a>
  </div>
  <div class="card" style="overflow:hidden;">
    <div style="background:linear-gradient(135deg,#0A2540,#0A7EA4);padding:28px 32px;">
      <div style="font-size:11px;font-weight:600;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.8px;margin-bottom:6px;">Compte rendu officiel</div>
      <div style="font-size:22px;font-weight:700;color:#fff;margin-bottom:4px;">{{ $meeting->titre }}</div>
      <div style="font-size:13px;color:rgba(255,255,255,.7);">{{ \Carbon\Carbon::parse($meeting->date_reunion)->translatedFormat('l d F Y') }} · {{ \Carbon\Carbon::parse($meeting->heure_debut)->format('H:i') }} · {{ $meeting->lieu }}</div>
    </div>
    <div style="padding:28px 32px;">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-hint);text-transform:uppercase;margin-bottom:8px;">Participants</div>
          @foreach($meeting->participants as $p)
          <div style="font-size:13px;color:var(--text);margin-bottom:4px;">• {{ $p->user->name ?? '?' }} <span style="color:var(--text-hint);">({{ $p->role_reunion }})</span></div>
          @endforeach
        </div>
        <div>
          <div style="font-size:11px;font-weight:600;color:var(--text-hint);text-transform:uppercase;margin-bottom:8px;">Infos</div>
          <div style="font-size:13px;color:var(--text);margin-bottom:4px;"><i class="fa-solid fa-clock" style="color:var(--text-hint);width:14px;"></i> Durée : {{ $meeting->duree }} minutes</div>
          <div style="font-size:13px;color:var(--text);margin-bottom:4px;"><i class="fa-solid fa-tag" style="color:var(--text-hint);width:14px;"></i> Type : {{ $meeting->type }}</div>
          <div style="font-size:13px;color:var(--text);"><i class="fa-solid fa-flag" style="color:var(--text-hint);width:14px;"></i> Priorité : {{ $meeting->priorite }}</div>
        </div>
      </div>

      @if($meeting->agendas->count())
      <div style="margin-bottom:20px;">
        <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:10px;padding-bottom:6px;border-bottom:1px solid var(--border);">📋 Ordre du jour</div>
        @foreach($meeting->agendas->sortBy('ordre') as $a)
        <div style="display:flex;gap:10px;margin-bottom:7px;align-items:center;">
          <div style="width:22px;height:22px;border-radius:6px;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;flex-shrink:0;">{{ $a->ordre }}</div>
          <div style="flex:1;font-size:13px;color:var(--text);">{{ $a->titre }}</div>
          <div style="font-size:11px;color:var(--text-hint);">{{ $a->duree }}min</div>
        </div>
        @endforeach
      </div>
      @endif

      @if($meeting->decisions->count())
      <div style="margin-bottom:20px;">
        <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:10px;padding-bottom:6px;border-bottom:1px solid var(--border);">✅ Décisions prises</div>
        @foreach($meeting->decisions as $d)
        <div style="display:flex;gap:8px;margin-bottom:7px;">
          <i class="fa-solid fa-circle-check" style="color:var(--accent);margin-top:2px;flex-shrink:0;"></i>
          <div style="font-size:13px;color:var(--text);">{{ $d->texte }}</div>
        </div>
        @endforeach
      </div>
      @endif

      @if($meeting->tasks->count())
      <div style="margin-bottom:20px;">
        <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:10px;padding-bottom:6px;border-bottom:1px solid var(--border);">📌 Actions à suivre</div>
        @foreach($meeting->tasks as $t)
        <div style="background:var(--surface-2);border-radius:8px;border:1px solid var(--border);padding:10px 12px;margin-bottom:6px;display:flex;align-items:center;gap:10px;">
          <span class="badge {{ $t->statut==='Terminee'?'badge-green':($t->statut==='En retard'?'badge-danger':'badge-blue') }}">{{ $t->statut }}</span>
          <div style="flex:1;font-size:13px;color:var(--text);">{{ $t->titre }}</div>
          <div style="font-size:11px;color:var(--text-hint);">{{ $t->responsable }}</div>
          @if($t->deadline)<div style="font-size:11px;color:var(--text-hint);">{{ \Carbon\Carbon::parse($t->deadline)->format('d/m/Y') }}</div>@endif
        </div>
        @endforeach
      </div>
      @endif

      @if($meeting->notes->count())
      <div>
        <div style="font-size:13px;font-weight:700;color:var(--text);margin-bottom:10px;padding-bottom:6px;border-bottom:1px solid var(--border);">📝 Notes</div>
        @foreach($meeting->notes as $n)
        <div style="font-size:13px;color:var(--text);line-height:1.6;background:var(--surface-2);border-radius:8px;padding:12px;border:1px solid var(--border);">{{ $n->contenu }}</div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
