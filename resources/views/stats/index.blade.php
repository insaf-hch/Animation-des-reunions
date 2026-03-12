@extends('layouts.app')
@section('title','Statistiques')
@section('styles')
<style>
.stats-hero{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px;}
.sh-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);padding:18px;box-shadow:var(--shadow-sm);transition:all .2s;}
.sh-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px);}
.sh-icon{width:44px;height:44px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:12px;}
.sh-val{font-size:28px;font-weight:800;color:var(--text);}
.sh-lbl{font-size:12px;color:var(--text-sub);margin-top:3px;}
.charts-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.chart-card{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);padding:20px;box-shadow:var(--shadow-sm);}
.chart-title{font-size:14px;font-weight:700;color:var(--text);margin-bottom:16px;display:flex;align-items:center;gap:8px;}
@media(max-width:900px){.stats-hero{grid-template-columns:repeat(2,1fr);}.charts-grid{grid-template-columns:1fr;}}
@media(max-width:480px){.stats-hero{grid-template-columns:1fr 1fr;}}
</style>
@endsection
@section('content')
<div style="font-size:20px;font-weight:800;color:var(--text);margin-bottom:20px;">📊 <span style="color:var(--primary);">Statistiques</span></div>
<div class="stats-hero">
  <div class="sh-card"><div class="sh-icon" style="background:var(--primary-light);color:var(--primary);"><i class="fa-solid fa-calendar-days"></i></div><div class="sh-val">{{ $totalMeetings }}</div><div class="sh-lbl">Réunions totales</div></div>
  <div class="sh-card"><div class="sh-icon" style="background:var(--accent-light);color:var(--accent);"><i class="fa-solid fa-list-check"></i></div><div class="sh-val">{{ $completedTasks }}</div><div class="sh-lbl">Tâches complétées</div></div>
  <div class="sh-card"><div class="sh-icon" style="background:var(--warn-light);color:var(--warn);"><i class="fa-solid fa-clock"></i></div><div class="sh-val">{{ $avgDuration }}<span style="font-size:16px;font-weight:500;">m</span></div><div class="sh-lbl">Durée moyenne</div></div>
  <div class="sh-card"><div class="sh-icon" style="background:var(--surface-2);color:var(--text-sub);border:1px solid var(--border);"><i class="fa-solid fa-users"></i></div><div class="sh-val">{{ $totalUsers }}</div><div class="sh-lbl">Membres actifs</div></div>
</div>
<div class="charts-grid">
  <div class="chart-card">
    <div class="chart-title"><i class="fa-solid fa-chart-bar" style="color:var(--primary);"></i> Réunions par mois</div>
    <canvas id="meetingsChart" height="200"></canvas>
  </div>
  <div class="chart-card">
    <div class="chart-title"><i class="fa-solid fa-chart-pie" style="color:var(--accent);"></i> Statut des tâches</div>
    <canvas id="tasksChart" height="200"></canvas>
  </div>
  <div class="chart-card">
    <div class="chart-title"><i class="fa-solid fa-chart-line" style="color:var(--warn);"></i> Taux de complétion</div>
    <canvas id="completionChart" height="200"></canvas>
  </div>
  <div class="chart-card">
    <div class="chart-title"><i class="fa-solid fa-users" style="color:var(--primary);"></i> Top participants</div>
    @foreach($topParticipants as $p)
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
      <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#0A7EA4,#16A34A);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#fff;flex-shrink:0;">{{ strtoupper(substr($p->user->name??'?',0,2)) }}</div>
      <div style="flex:1;">
        <div style="font-size:13px;font-weight:500;color:var(--text);">{{ $p->user->name ?? 'Inconnu' }}</div>
        <div style="height:4px;background:var(--border);border-radius:4px;margin-top:4px;"><div style="height:100%;background:linear-gradient(90deg,#0A7EA4,#16A34A);border-radius:4px;width:{{ min(100, $p->count * 20) }}%;"></div></div>
      </div>
      <div style="font-size:12px;color:var(--text-hint);">{{ $p->count }} réunions</div>
    </div>
    @endforeach
  </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
const textColor = isDark ? '#94A3B8' : '#4B5563';
const gridColor = isDark ? 'rgba(255,255,255,.06)' : 'rgba(0,0,0,.06)';
const defaults = { color: textColor, plugins:{ legend:{ labels:{ color: textColor }}}};

new Chart(document.getElementById('meetingsChart'), {
  type:'bar',
  data:{
    labels: {!! json_encode($monthlyLabels) !!},
    datasets:[{label:'Réunions',data:{!! json_encode($monthlyData) !!},backgroundColor:'rgba(10,126,164,.7)',borderRadius:6}]
  },
  options:{...defaults, scales:{x:{ticks:{color:textColor},grid:{color:gridColor}},y:{ticks:{color:textColor},grid:{color:gridColor}}}}
});

new Chart(document.getElementById('tasksChart'), {
  type:'doughnut',
  data:{
    labels:['En cours','Terminées','En retard'],
    datasets:[{data:[{{ $taskStats['en_cours'] }},{{ $taskStats['terminees'] }},{{ $taskStats['en_retard'] }}],backgroundColor:['#0A7EA4','#16A34A','#DC2626'],borderWidth:0}]
  },
  options:{...defaults, cutout:'65%'}
});

new Chart(document.getElementById('completionChart'), {
  type:'line',
  data:{
    labels:{!! json_encode($monthlyLabels) !!},
    datasets:[{label:'Taux %',data:{!! json_encode($completionData) !!},borderColor:'#16A34A',backgroundColor:'rgba(22,163,74,.1)',tension:.4,fill:true}]
  },
  options:{...defaults, scales:{x:{ticks:{color:textColor},grid:{color:gridColor}},y:{min:0,max:100,ticks:{color:textColor},grid:{color:gridColor}}}}
});
</script>
@endsection
