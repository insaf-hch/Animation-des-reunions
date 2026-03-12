@extends('layouts.app')
@section('title','Tâches')
@section('styles')
<style>
.page-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.tasks-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.task-col{background:var(--surface);border-radius:var(--r-lg);border:1px solid var(--border);overflow:hidden;}
.task-col-head{padding:12px 14px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.task-col-title{font-size:13px;font-weight:700;color:var(--text);display:flex;align-items:center;gap:7px;}
.task-col-count{font-size:11px;font-weight:600;padding:2px 8px;border-radius:100px;}
.task-col-body{padding:10px;}
.task-card{background:var(--surface-2);border-radius:9px;border:1px solid var(--border);padding:11px 13px;margin-bottom:7px;cursor:pointer;transition:all .15s;}
.task-card:hover{border-color:var(--primary);box-shadow:0 2px 10px rgba(0,0,0,.08);}
.task-card-title{font-size:13px;font-weight:500;color:var(--text);margin-bottom:7px;}
.task-card-meta{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:5px;}
.task-card-meta span{font-size:11px;color:var(--text-hint);display:flex;align-items:center;gap:3px;}
.priority-dot{width:7px;height:7px;border-radius:50%;display:inline-block;flex-shrink:0;}
.p-normal{background:var(--accent);}
.p-important{background:var(--warn);}
.p-urgent{background:var(--danger);}
@media(max-width:900px){.tasks-grid{grid-template-columns:1fr;}}
</style>
@endsection
@section('content')
<div class="page-head">
  <div>
    <div style="font-size:20px;font-weight:800;color:var(--text);">✅ Mes <span style="color:var(--primary);">Tâches</span></div>
    <div style="font-size:12px;color:var(--text-hint);margin-top:2px;">{{ $tasks->count() }} tâche(s) au total</div>
  </div>
</div>
<div class="tasks-grid">
  @foreach([['En cours','var(--primary)','badge-blue'],['En retard','var(--danger)','badge-danger'],['Terminee','var(--accent)','badge-green']] as [$statut,$color,$badge])
  @php $filtered = $tasks->where('statut',$statut); @endphp
  <div class="task-col">
    <div class="task-col-head">
      <div class="task-col-title" style="color:{{ $color }};"><i class="fa-solid fa-circle-dot"></i> {{ $statut === 'Terminee' ? 'Terminées' : $statut }}</div>
      <span class="task-col-count {{ $badge }}">{{ $filtered->count() }}</span>
    </div>
    <div class="task-col-body">
      @forelse($filtered as $task)
      <div class="task-card">
        <div class="task-card-title">{{ $task->titre }}</div>
        <div class="task-card-meta">
          <span><i class="fa-solid fa-calendar"></i> {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : 'Pas de deadline' }}</span>
          <span>
            <span class="priority-dot p-{{ strtolower($task->priorite) }}"></span>
            {{ $task->priorite }}
          </span>
        </div>
        @if($task->responsable)
        <div style="margin-top:6px;font-size:11px;color:var(--text-hint);display:flex;align-items:center;gap:4px;">
          <i class="fa-solid fa-user"></i> {{ $task->responsable }}
        </div>
        @endif
        <div style="margin-top:8px;display:flex;gap:6px;">
          @foreach(['En cours','Terminee'] as $s)
          @if($task->statut !== $s)
          <form method="POST" action="{{ route('tasks.update', $task->id) }}">
            @csrf @method('PATCH')
            <input type="hidden" name="statut" value="{{ $s }}"/>
            <button type="submit" class="btn btn-secondary btn-sm" style="font-size:10px;padding:3px 9px;">
              {{ $s === 'Terminee' ? '✓ Terminer' : '↩ Reprendre' }}
            </button>
          </form>
          @endif
          @endforeach
        </div>
      </div>
      @empty
      <div style="text-align:center;padding:20px;color:var(--text-hint);font-size:12px;">Aucune tâche</div>
      @endforelse
    </div>
  </div>
  @endforeach
</div>
@endsection
