@extends('layouts.app')
@section('title','Calendrier')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/resource-timeline.min.css" rel="stylesheet" />
<style>
#calendar {max-width:100%;margin:0 auto;}
.fc .fc-resource{font-size:13px;}
.fc .fc-resource .fc-cell-text{display:flex;align-items:center;gap:8px;}
.fc .fc-resource img{width:24px;height:24px;border-radius:50%;object-fit:cover;}
</style>
@endsection
@section('content')
<div class="page-head">
  <div>
    <div class="page-title">📅 <span>Calendrier des réunions</span></div>
  </div>
</div>
<div id="calendar"></div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/resource-timeline.min.js"></script>
<script>
@php
$events = [];
foreach($meetings as $m){
    foreach($m->participants as $p){
        if(!$p->user) continue;
        $events[] = [
            'title' => $m->titre,
            'start' => $m->date_reunion . 'T' . $m->heure_debut,
            'end' => \Carbon\Carbon::parse($m->date_reunion.'T'.$m->heure_debut)->addMinutes($m->duree)->toIso8601String(),
            'resourceId' => $p->user->id,
            'url' => route('meetings.room', $m->id),
            'color' => $m->statut === 'Terminee' ? '#CBD5E1' : ($m->statut === 'En cours' ? '#0A7EA4' : '#16A34A'),
        ];
    }
}
// convert passed resources to FC format
$fcResources = [];
foreach($resources as $r){
    $fcResources[] = ['id'=>$r['id'],'title'=>$r['title']];
}
@endphp

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'resourceTimelineMonth',
    resourceAreaHeaderContent: 'Participants',
    resources: {!! json_encode($fcResources) !!},
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'resourceTimelineMonth,resourceTimelineWeek,resourceTimelineDay'
    },
    events: {!! json_encode($events) !!},
    eventClick: function(info){
      if(info.event.url){ window.location.href = info.event.url; info.jsEvent.preventDefault(); }
    }
  });
  console.log('FC resources', {!! json_encode($fcResources) !!});
  console.log('FC events', {!! json_encode($events) !!});
  calendar.render();
});
</script>
@endsection