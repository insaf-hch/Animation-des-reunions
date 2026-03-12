@extends('layouts.app')
@section('title','Participants')
@section('content')
<div style="font-size:20px;font-weight:800;color:var(--text);margin-bottom:20px;">👥 <span style="color:var(--primary);">Participants</span></div>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:14px;">
  @foreach($users as $i => $user)
  @php $colors=['#0A7EA4','#16A34A','#7C3AED','#D97706','#DC2626','#0891B2']; @endphp
  <div class="card" style="padding:20px;text-align:center;">
    <div style="width:60px;height:60px;border-radius:50%;background:{{ $colors[$i%count($colors)] }};display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:700;color:#fff;margin:0 auto 12px;">{{ strtoupper(substr($user->name,0,2)) }}</div>
    <div style="font-size:15px;font-weight:600;color:var(--text);">{{ $user->name }}</div>
    <div style="font-size:12px;color:var(--text-hint);margin-top:2px;">{{ $user->email }}</div>
    <div style="margin-top:8px;"><span class="badge badge-blue">{{ $user->role }}</span></div>
    <div style="margin-top:12px;display:flex;gap:8px;justify-content:center;font-size:12px;color:var(--text-sub);">
      <span><i class="fa-solid fa-calendar-days" style="color:var(--primary);"></i> {{ $user->participants->count() }} réunions</span>
    </div>
  </div>
  @endforeach
</div>
@endsection
