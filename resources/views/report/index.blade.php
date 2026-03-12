@extends('layouts.app')
@section('title','Comptes rendus')
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
  <div style="font-size:20px;font-weight:800;color:var(--text);">📄 Comptes <span style="color:var(--primary);">Rendus</span></div>
</div>
@forelse($meetings as $meeting)
<div class="card" style="padding:16px 20px;margin-bottom:10px;display:flex;align-items:center;gap:14px;">
  <div style="width:44px;height:44px;border-radius:10px;background:var(--primary-light);color:var(--primary);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
    <i class="fa-solid fa-file-lines"></i>
  </div>
  <div style="flex:1;min-width:0;">
    <div style="font-size:14px;font-weight:600;color:var(--text);">{{ $meeting->titre }}</div>
    <div style="font-size:12px;color:var(--text-hint);">{{ \Carbon\Carbon::parse($meeting->date_reunion)->translatedFormat('l d F Y') }} · {{ $meeting->lieu }}</div>
  </div>
  <div style="display:flex;gap:8px;">
    <a href="{{ route('report.show', $meeting->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i> Voir CR</a>
    <a href="{{ route('report.pdf', $meeting->id) }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-file-pdf"></i> PDF</a>
  </div>
</div>
@empty
<div style="text-align:center;padding:60px;color:var(--text-hint);">
  <i class="fa-solid fa-file-circle-xmark" style="font-size:48px;display:block;margin-bottom:12px;color:var(--border-2);"></i>
  <p>Aucun compte rendu disponible</p>
</div>
@endforelse
@endsection
