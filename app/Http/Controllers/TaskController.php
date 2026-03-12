<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
class TaskController extends Controller {
  public function index() {
    $tasks = Task::orderByRaw("FIELD(statut,'En retard','En cours','Terminee')")->get();
    return view('tasks.index', compact('tasks'));
  }
  public function update(Request $req, Task $task) {
    $task->update(['statut' => $req->statut]);
    return back()->with('success','Tâche mise à jour.');
  }
}
