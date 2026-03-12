@extends('layouts.app')
@section('title','Tableau de bord')
@section('styles')
<style>
.welcome-banner{border-radius:var(--r-xl);background:linear-gradient(135deg,#0A2540 0%,#0A7EA4 55%,#16A34A 100%);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:18px;position:relative;overflow:hidden;box-shadow:0 8px 32px rgba(10,126,164,.25);}
.welcome-banner::before{content:'';position:absolute;width:250px;height:250px;border-radius:50%;background:rgba(255,255,255,.05);right:-50px;top:-70px;}
.wb-text{position:relative;z-index:1;}
.wb-text h2{font-size:18px;font-weight:700;color:#fff;margin-bottom:3px;}
.wb-text p{font-size:12px;color:rgba(255,255,255,.7);}
.wb-text p strong{color:#fff;}
.wb-btn{position:relative;z-index:1;display:flex;align-items:center;gap:7px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;border-radius:9px;padding:9px 16px;font-family:inherit;font-size:12px;font-weight:600;cursor:pointer;transition:background .15s;white-space:nowrap;flex-shrink:0;text-decoration:none;}
.wb-btn:hover{background:rgba(255,255,255,.22);}

.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:18px;}
.stat-card{background:var(--surface);border-radius:var(--r-lg);padding:16px;border:1px solid var(--border);display:flex;align-items:flex-start;gap:12px;box-shadow:var(--shadow-sm);transition:box-shadow .2s,transform .2s,background .3s;}
.stat-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px);}
.stat-ico{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
.stat-val{font-size:24px;font-weight:800;line-height:1;color:var(--text);}
.stat-lbl{font-size:11px;color:var(--text-sub);margin-top:3px;}
.stat-trend{font-size:10px;margin-top:5px;display:flex;align-items:center;gap:3px;}
.up{color:var(--accent);} .down{color:var(--danger);} .flat{color:var(--text-hint);}

.main-grid{display:grid;grid-template-columns:1fr 300px;gap:16px;}

.meeting-list{display:flex;flex-direction:column;gap:8px;}
.meeting-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);padding:12px 14px;display:flex;align-items:center;gap:12px;cursor:pointer;transition:all .15s;box-shadow:var(--shadow-sm);position:relative;overflow:hidden;text-decoration:none;}
.meeting-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:transparent;transition:background .15s;}
.meeting-card:hover{box-shadow:var(--shadow-md);border-color:var(--primary);transform:translateX(2px);}
.meeting-card:hover::before{background:var(--primary);}
.meeting-card.today::before{background:var(--accent);}
.meeting-card.urgent::before{background:var(--warn);}
.meet-date{width:42px;flex-shrink:0;text-align:center;border-radius:9px;padding:6px 4px;}
.meet-day{font-size:20px;font-weight:800;line-height:1;}
.meet-mon{font-size:9px;font-weight:600;text-transform:uppercase;opacity:.7;}
.meet-body{flex:1;min-width:0;}
.meet-title{font-size:13px;font-weight:600;color:var(--text);margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.meet-meta{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.meet-meta span{font-size:11px;color:var(--text-hint);display:flex;align-items:center;gap:3px;}

.right-col{display:flex;flex-direction:column;gap:14px;}
.card-pad{padding:14px;}

.cal-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;}
.cal-month{font-size:13px;font-weight:700;color:var(--text);}
.cal-navs{display:flex;gap:3px;}
.cal-nb{width:24px;height:24px;border-radius:6px;border:1px solid var(--border);background:var(--surface-2);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:9px;color:var(--text-sub);transition:all .15s;}
.cal-nb:hover{border-color:var(--primary);color:var(--primary);}
.cal-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:1px;}
.cal-dow{text-align:center;font-size:9px;font-weight:600;color:var(--text-hint);padding:3px 0;}
.cal-day{text-align:center;font-size:11px;padding:5px 2px;border-radius:5px;cursor:pointer;color:var(--text-sub);transition:background .1s;position:relative;}
.cal-day:hover{background:var(--surface-2);color:var(--text);}
.cal-day.today{background:linear-gradient(135deg,#0A7EA4,#16A34A);color:#fff;font-weight:700;}
.cal-day.has-e{color:var(--primary);font-weight:600;}
.cal-day.has-e::after{content:'';position:absolute;bottom:1px;left:50%;transform:translateX(-50%);width:3px;height:3px;border-radius:50%;background:var(--accent);}
.cal-day.other{color:var(--text-hint);opacity:.4;}

.task-item{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;border:1px solid var(--border);margin-bottom:5px;cursor:pointer;transition:all .15s;}
.task-item:last-child{margin-bottom:0;}
.task-item:hover{border-color:var(--primary);background:var(--primary-light);}
.task-chk{width:16px;height:16px;border-radius:50%;border:2px solid var(--border);flex-shrink:0;display:flex;align-items:center;justify-content:center;transition:all .15s;cursor:pointer;}
.task-chk.done{background:var(--accent);border-color:var(--accent);}
.task-chk.done::after{content:'✓';font-size:8px;color:#fff;font-weight:700;}
.task-txt{flex:1;font-size:12px;color:var(--text);}
.task-txt.done{text-decoration:line-through;color:var(--text-hint);}
.task-due{font-size:10px;color:var(--text-hint);white-space:nowrap;}
.task-due.overdue{color:var(--danger);font-weight:600;}

.quick-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;}
.quick-btn{display:flex;flex-direction:column;align-items:center;gap:5px;padding:12px 8px;border-radius:9px;border:1.5px solid var(--border);background:var(--surface-2);cursor:pointer;transition:all .15s;text-decoration:none;}
.quick-btn:hover{border-color:var(--primary);background:var(--primary-light);}
.quick-btn:hover .qi,.quick-btn:hover .ql{color:var(--primary);}
.qi{font-size:18px;color:var(--text-sub);transition:color .15s;}
.ql{font-size:10px;font-weight:500;color:var(--text-sub);text-align:center;transition:color .15s;}

.status-bar{display:flex;align-items:center;gap:8px;padding:7px 12px;border-radius:8px;background:var(--accent-light);border:1px solid rgba(22,163,74,.2);font-size:11px;color:var(--accent);font-weight:500;margin-bottom:14px;}
.s-dot{width:7px;height:7px;border-radius:50%;background:var(--accent);animation:pulse 2s infinite;flex-shrink:0;}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.6;transform:scale(1.2)}}

@media(max-width:1024px){.main-grid{grid-template-columns:1fr;}.right-col{display:grid;grid-template-columns:1fr 1fr;}.stats-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:640px){.stats-grid{grid-template-columns:repeat(2,1fr);gap:8px;}.main-grid{grid-template-columns:1fr;}.right-col{display:flex;flex-direction:column;}.welcome-banner{flex-direction:column;align-items:flex-start;}.wb-btn{align-self:stretch;justify-content:center;}}
</style>
@endsection
@section('content')

@php
  $today = now()->toDateString();
  $todayMeetings = $meetings->filter(fn($m) => \Carbon\Carbon::parse($m->date_reunion)->toDateString() === $today);
  $userName = explode(' ', Auth::user()->name)[0];
  $currentDay = now()->day;
  $currentMonth = now()->translatedFormat('M');
@endphp

@if($todayMeetings->count() > 0)
<div class="status-bar">
  <div class="s-dot"></div>
  <span>{{ $todayMeetings->count() }} réunion(s) aujourd'hui — Prochaine :
    <strong>{{ $todayMeetings->first()->titre }} à {{ \Carbon\Carbon::parse($todayMeetings->first()->heure_debut)->format('H:i') }}</strong>
  </span>
</div>
@endif

<div class="welcome-banner">
  <div class="wb-text">
    <h2>Bonjour, {{ $userName }} 👋</h2>
    <p>Vous avez <strong>{{ $todayMeetings->count() }} réunion(s)</strong> aujourd'hui et <strong>{{ $pendingTasks }}</strong> tâche(s) en attente.</p>
  </div>
  @if($todayMeetings->count() > 0)
  <a href="{{ route('meetings.room', $todayMeetings->first()->id) }}" class="wb-btn">
    <i class="fa-solid fa-play"></i> Démarrer la réunion
  </a>
  @else
  <a href="{{ route('meetings.create') }}" class="wb-btn">
    <i class="fa-solid fa-plus"></i> Nouvelle réunion
  </a>
  @endif
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-ico" style="background:var(--primary-light);color:var(--primary);"><i class="fa-solid fa-calendar-days"></i></div>
    <div>
      <div class="stat-val">{{ $monthMeetings }}</div>
      <div class="stat-lbl">Réunions ce mois</div>
      <div class="stat-trend up"><i class="fa-solid fa-arrow-trend-up"></i> Ce mois</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-ico" style="background:var(--accent-light);color:var(--accent);"><i class="fa-solid fa-list-check"></i></div>
    <div>
      <div class="stat-val">{{ $completedTasks }}</div>
      <div class="stat-lbl">Tâches complétées</div>
      <div class="stat-trend up"><i class="fa-solid fa-arrow-trend-up"></i> {{ $completedTasks > 0 ? round($completedTasks/max($totalTasks,1)*100) : 0 }}% complétion</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-ico" style="background:var(--warn-light);color:var(--warn);"><i class="fa-solid fa-clock"></i></div>
    <div>
      <div class="stat-val">{{ $avgDuration }}<span style="font-size:13px;font-weight:500;">m</span></div>
      <div class="stat-lbl">Durée moyenne</div>
      <div class="stat-trend flat"><i class="fa-solid fa-minus"></i> Par réunion</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-ico" style="background:var(--surface-2);color:var(--text-sub);border:1px solid var(--border);"><i class="fa-solid fa-users"></i></div>
    <div>
      <div class="stat-val">{{ $totalUsers }}</div>
      <div class="stat-lbl">Membres actifs</div>
      <div class="stat-trend flat"><i class="fa-solid fa-circle-check"></i> Équipe</div>
    </div>
  </div>
</div>

<div class="main-grid">
  <div>
    <div class="sec-head">
      <div class="sec-title"><i class="fa-solid fa-calendar-days" style="color:var(--primary);"></i> Réunions à venir</div>
      <a href="{{ route('meetings.index') }}" class="sec-link">Voir toutes →</a>
    </div>
    <div class="meeting-list">
      @forelse($meetings->take(5) as $meeting)
      @php
        $mDate = \Carbon\Carbon::parse($meeting->date_reunion);
        $isToday = $mDate->isToday();
        $isUrgent = $meeting->priorite === 'Urgent';
        $colorClass = $isToday ? 'today' : ($isUrgent ? 'urgent' : '');
        $bgColor = $isToday ? 'var(--accent-light)' : ($isUrgent ? 'var(--warn-light)' : 'var(--primary-light)');
        $txtColor = $isToday ? 'var(--accent)' : ($isUrgent ? 'var(--warn)' : 'var(--primary)');
      @endphp
      <a href="{{ route('meetings.room', $meeting->id) }}" class="meeting-card {{ $colorClass }}">
        <div class="meet-date" style="background:{{ $bgColor }};">
          <div class="meet-day" style="color:{{ $txtColor }};">{{ $mDate->format('d') }}</div>
          <div class="meet-mon" style="color:{{ $txtColor }};">{{ $mDate->translatedFormat('M') }}</div>
        </div>
        <div class="meet-body">
          <div class="meet-title">{{ $meeting->titre }}</div>
          <div class="meet-meta">
            <span><i class="fa-solid fa-clock"></i> {{ \Carbon\Carbon::parse($meeting->heure_debut)->format('H:i') }}</span>
            <span><i class="fa-solid fa-location-dot"></i> {{ $meeting->lieu }}</span>
          </div>
        </div>
        @if($isToday)
          <span class="badge badge-green">Aujourd'hui</span>
        @elseif($isUrgent)
          <span class="badge badge-warn">Urgent</span>
        @else
          <span class="badge badge-blue">À venir</span>
        @endif
      </a>
      @empty
      <div style="text-align:center;padding:32px;color:var(--text-hint);">
        <i class="fa-solid fa-calendar-xmark" style="font-size:32px;margin-bottom:8px;display:block;"></i>
        Aucune réunion à venir
      </div>
      @endforelse
    </div>
  </div>

  <div class="right-col">
    <div class="card card-pad">
      <div class="cal-head">
        <div class="cal-month">{{ now()->translatedFormat('F Y') }}</div>
        <div class="cal-navs">
          <button class="cal-nb"><i class="fa-solid fa-chevron-left"></i></button>
          <button class="cal-nb"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
      </div>
      <div class="cal-grid">
        @foreach(['Lu','Ma','Me','Je','Ve','Sa','Di'] as $d)
          <div class="cal-dow">{{ $d }}</div>
        @endforeach
        @php
          $firstDay = now()->startOfMonth()->dayOfWeekIso;
          $daysInMonth = now()->daysInMonth;
          $meetingDays = $meetings->map(fn($m) => \Carbon\Carbon::parse($m->date_reunion)->day)->toArray();
        @endphp
        @for($i = 1; $i < $firstDay; $i++)
          <div class="cal-day other">{{ now()->startOfMonth()->subDays($firstDay - $i)->day }}</div>
        @endfor
        @for($d = 1; $d <= $daysInMonth; $d++)
          @php $cls = $d === now()->day ? 'today' : (in_array($d, $meetingDays) ? 'has-e' : ''); @endphp
          <div class="cal-day {{ $cls }}">{{ $d }}</div>
        @endfor
      </div>
    </div>

    <div class="card card-pad">
      <div class="sec-head">
        <div class="sec-title"><i class="fa-solid fa-list-check" style="color:var(--accent);font-size:13px;"></i> Tâches urgentes</div>
        <a href="{{ route('tasks.index') }}" class="sec-link">Voir tout →</a>
      </div>
      @forelse($urgentTasks as $task)
      @php
        $isDone = $task->statut === 'Terminee';
        $isLate = $task->statut === 'En retard';
      @endphp
      <div class="task-item">
        <div class="task-chk {{ $isDone ? 'done' : '' }}"></div>
        <div class="task-txt {{ $isDone ? 'done' : '' }}">{{ $task->titre }}</div>
        <div class="task-due {{ $isLate ? 'overdue' : '' }}">
          {{ $isDone ? 'Fait' : ($isLate ? 'Retard' : \Carbon\Carbon::parse($task->deadline)->format('d M')) }}
        </div>
      </div>
      @empty
      <div style="text-align:center;padding:16px;color:var(--text-hint);font-size:12px;">
        <i class="fa-solid fa-circle-check" style="color:var(--accent);"></i> Tout est à jour !
      </div>
      @endforelse
    </div>

    <div class="card card-pad">
      <div class="sec-title" style="margin-bottom:10px;"><i class="fa-solid fa-bolt" style="color:var(--warn);font-size:13px;"></i> Actions rapides</div>
      <div class="quick-grid">
        <a href="{{ route('meetings.create') }}" class="quick-btn"><div class="qi"><i class="fa-solid fa-plus"></i></div><div class="ql">Nouvelle réunion</div></a>
        @if($todayMeetings->count() > 0)
        <a href="{{ route('meetings.room', $todayMeetings->first()->id) }}" class="quick-btn"><div class="qi"><i class="fa-solid fa-play"></i></div><div class="ql">Démarrer</div></a>
        @else
        <a href="{{ route('meetings.index') }}" class="quick-btn"><div class="qi"><i class="fa-solid fa-play"></i></div><div class="ql">Démarrer</div></a>
        @endif
        <a href="{{ route('report.index') }}" class="quick-btn"><div class="qi"><i class="fa-solid fa-file-pdf"></i></div><div class="ql">Comptes rendus</div></a>
        <a href="{{ route('stats.index') }}" class="quick-btn"><div class="qi"><i class="fa-solid fa-chart-line"></i></div><div class="ql">Statistiques</div></a>
      </div>
    </div>
  </div>
</div>
@endsection
