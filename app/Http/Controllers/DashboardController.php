<?php
namespace App\Http\Controllers;
use App\Models\Meeting; use App\Models\Task; use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller {
  public function index() {
    $meetings = Meeting::with(['participants.user'])
      ->where('statut','!=','Terminee')
      ->orderBy('date_reunion')->orderBy('heure_debut')
      ->get();
    $urgentTasks = Task::where('statut','!=','Terminee')
      ->orderByRaw("FIELD(statut,'En retard','En cours')")
      ->take(5)->get();
    return view('dashboard', [
      'meetings'       => $meetings,
      'urgentTasks'    => $urgentTasks,
      'pendingTasks'   => Task::where('statut','!=','Terminee')->count(),
      'completedTasks' => Task::where('statut','Terminee')->count(),
      'totalTasks'     => Task::count(),
      'monthMeetings'  => Meeting::whereMonth('date_reunion', now()->month)->count(),
      'avgDuration'    => (int) Meeting::avg('duree') ?: 0,
      'totalUsers'     => User::count(),
    ]);
  }
}
