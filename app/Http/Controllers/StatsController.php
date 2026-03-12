<?php
namespace App\Http\Controllers;
use App\Models\Meeting; use App\Models\Task; use App\Models\User; use App\Models\Participant;
use Illuminate\Support\Facades\DB;
class StatsController extends Controller {
  public function index() {
    $months = collect(range(5,0))->map(fn($i) => now()->subMonths($i));
    $monthlyLabels = $months->map(fn($m) => $m->translatedFormat('M'))->toArray();
    $monthlyData   = $months->map(fn($m) => Meeting::whereYear('date_reunion',$m->year)->whereMonth('date_reunion',$m->month)->count())->toArray();
    $completionData= $months->map(function($m){
      $total = Task::whereMonth('created_at',$m->month)->count();
      $done  = Task::whereMonth('created_at',$m->month)->where('statut','Terminee')->count();
      return $total > 0 ? round($done/$total*100) : 0;
    })->toArray();
    $topParticipants = Participant::select('user_id', DB::raw('count(*) as count'))
      ->groupBy('user_id')->orderByDesc('count')->take(5)
      ->with('user')->get();
    return view('stats.index', [
      'totalMeetings'   => Meeting::count(),
      'completedTasks'  => Task::where('statut','Terminee')->count(),
      'avgDuration'     => (int) Meeting::avg('duree') ?: 0,
      'totalUsers'      => User::count(),
      'monthlyLabels'   => $monthlyLabels,
      'monthlyData'     => $monthlyData,
      'completionData'  => $completionData,
      'topParticipants' => $topParticipants,
      'taskStats'       => [
        'en_cours'  => Task::where('statut','En cours')->count(),
        'terminees' => Task::where('statut','Terminee')->count(),
        'en_retard' => Task::where('statut','En retard')->count(),
      ],
    ]);
  }
}
