<?php
namespace App\Http\Controllers;
use App\Models\User;
class ParticipantController extends Controller {
  public function index() {
    $users = User::withCount(['participants'])->with('participants')->get();
    return view('participants.index', compact('users'));
  }
}
