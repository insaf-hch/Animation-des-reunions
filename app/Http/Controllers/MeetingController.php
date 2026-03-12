<?php
namespace App\Http\Controllers;
use App\Models\Meeting; use App\Models\User; use App\Models\Participant;
use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth;
class MeetingController extends Controller {
  public function index(Request $req) {
    $q = Meeting::with(['participants.user']);
    if($req->statut) $q->where('statut',$req->statut);
    $meetings = $q->orderBy('date_reunion','desc')->paginate(12);
    return view('meetings.index', compact('meetings'));
  }
  public function create() {
    $users = User::all();
    return view('meetings.edit', compact('users'));
  }
  public function store(Request $req) {
    $req->validate(['titre'=>'required','date_reunion'=>'required|date','heure_debut'=>'required','duree'=>'required|integer']);
    $meeting = Meeting::create([
      'titre'        => $req->titre,
      'type'         => $req->type ?? 'Autre',
      'lieu'         => $req->lieu ?? '',
      'date_reunion' => $req->date_reunion,
      'heure_debut'  => $req->heure_debut,
      'duree'        => $req->duree,
      'statut'       => 'A venir',
      'priorite'     => $req->priorite ?? 'Normal',
      'lien_reunion' => $req->lien_reunion,
      'createur_id'  => Auth::id(),
    ]);
    if($req->participants) {
      foreach($req->participants as $uid) {
        Participant::create([
          'meeting_id'   => $meeting->id,
          'user_id'      => $uid,
          'role_reunion' => $req->roles[$uid] ?? 'Participant',
          'presence'     => false,
        ]);
      }
    }
    return redirect()->route('meetings.index')->with('success','Réunion créée avec succès !');
  }
  public function edit(Meeting $meeting) {
    $users = User::all();
    return view('meetings.edit', compact('meeting','users'));
  }
  public function update(Request $req, Meeting $meeting) {
    $meeting->update([
      'titre'        => $req->titre,
      'type'         => $req->type,
      'lieu'         => $req->lieu,
      'date_reunion' => $req->date_reunion,
      'heure_debut'  => $req->heure_debut,
      'duree'        => $req->duree,
      'priorite'     => $req->priorite,
      'lien_reunion' => $req->lien_reunion,
    ]);
    $meeting->participants()->delete();
    if($req->participants) {
      foreach($req->participants as $uid) {
        Participant::create(['meeting_id'=>$meeting->id,'user_id'=>$uid,'role_reunion'=>$req->roles[$uid]??'Participant','presence'=>false]);
      }
    }
    return redirect()->route('meetings.index')->with('success','Réunion mise à jour !');
  }
  public function destroy(Meeting $meeting) {
    $meeting->delete();
    return redirect()->route('meetings.index')->with('success','Réunion supprimée.');
  }
  public function calendar() {
    $meetings = Meeting::with('participants.user')->get();

    // build unique list of users participating in any meeting
    $resources = [];
    foreach ($meetings as $m) {
      foreach ($m->participants as $p) {
        $u = $p->user;
        if ($u && ! isset($resources[$u->id])) {
          $resources[$u->id] = ['id' => $u->id, 'title' => $u->name];
        }
      }
    }
    // re-index
    $resources = array_values($resources);

    return view('meetings.calendar', compact('meetings','resources'));
  }

  public function room(Meeting $meeting) {
    $meeting->load(['participants.user','agendas','decisions','tasks','notes']);
    if($meeting->statut === 'A venir') $meeting->update(['statut'=>'En cours']);
    return view('meetings.room', compact('meeting'));
  }
  public function end(Meeting $meeting) {
    $meeting->update(['statut'=>'Terminee']);
    return redirect()->route('report.show',$meeting->id)->with('success','Réunion terminée ! Voici le compte rendu.');
  }
}
