<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; use App\Models\Meeting; use App\Models\Participant;
use App\Models\Agenda; use App\Models\Task; use App\Models\Decision;
class DatabaseSeeder extends Seeder {
  public function run(): void {
    $users = [
      ['name'=>'Ahmed Karimi',   'email'=>'ahmed@smartmeeting.ma',   'role'=>'Chef de projet'],
      ['name'=>'Sara Mansouri',  'email'=>'sara@smartmeeting.ma',    'role'=>'Membre'],
      ['name'=>'Yassine Morin',  'email'=>'yassine@smartmeeting.ma', 'role'=>'Membre'],
      ['name'=>'Lina Benali',    'email'=>'lina@smartmeeting.ma',    'role'=>'Consultant'],
      ['name'=>'Nadia Rachidi',  'email'=>'nadia@smartmeeting.ma',   'role'=>'Membre'],
      ['name'=>'Omar Tazi',      'email'=>'omar@smartmeeting.ma',    'role'=>'Directeur'],
    ];
    $createdUsers = [];
    foreach($users as $u) {
      $createdUsers[] = User::create(['name'=>$u['name'],'email'=>$u['email'],'password'=>Hash::make('password'),'role'=>$u['role']]);
    }
    $ahmed = $createdUsers[0];

    $meetings = [
      ['titre'=>'Réunion de lancement — Projet Alpha','type'=>'Réunion de lancement','lieu'=>'Salle A','date_reunion'=>now()->toDateString(),'heure_debut'=>'09:00','duree'=>90,'statut'=>'A venir','priorite'=>'Important'],
      ['titre'=>'Réunion de suivi hebdomadaire','type'=>'Réunion de suivi','lieu'=>'Salle B','date_reunion'=>now()->toDateString(),'heure_debut'=>'14:00','duree'=>60,'statut'=>'A venir','priorite'=>'Normal'],
      ['titre'=>'Revue de sprint — Équipe Dev','type'=>'Revue de sprint','lieu'=>'Zoom','date_reunion'=>now()->addDays(2)->toDateString(),'heure_debut'=>'10:00','duree'=>90,'statut'=>'A venir','priorite'=>'Normal'],
      ['titre'=>'Comité de pilotage — Direction','type'=>'Comité de pilotage','lieu'=>'Salle de conférence','date_reunion'=>now()->addDays(5)->toDateString(),'heure_debut'=>'09:00','duree'=>180,'statut'=>'A venir','priorite'=>'Urgent'],
      ['titre'=>'Bilan mensuel — Mars 2026','type'=>'Réunion de suivi','lieu'=>'Teams','date_reunion'=>now()->subDays(5)->toDateString(),'heure_debut'=>'10:00','duree'=>60,'statut'=>'Terminee','priorite'=>'Normal'],
    ];

    foreach($meetings as $md) {
      $m = Meeting::create(array_merge($md, ['createur_id'=>$ahmed->id]));
      foreach($createdUsers as $i => $u) {
        Participant::create(['meeting_id'=>$m->id,'user_id'=>$u->id,'role_reunion'=>$i===0?'Animateur':($i===1?'Rapporteur':'Participant'),'presence'=>$m->statut==='Terminee']);
      }
      foreach([['Accueil et tour de table',10,1],['Point principal',20,2],['Questions et clôture',10,3]] as [$t,$d,$o]) {
        Agenda::create(['meeting_id'=>$m->id,'titre'=>$t,'duree'=>$d,'ordre'=>$o,'statut'=>'En attente']);
      }
    }

    $tasks = [
      ['titre'=>'Préparer l\'ordre du jour — Réunion Alpha','priorite'=>'Urgent','statut'=>'En retard','responsable'=>'Ahmed Karimi'],
      ['titre'=>'Envoyer le CR de la réunion du 3 mars','priorite'=>'Important','statut'=>'En retard','responsable'=>'Sara Mansouri'],
      ['titre'=>'Réserver la salle de conférence','priorite'=>'Normal','statut'=>'En cours','responsable'=>'Ahmed Karimi'],
      ['titre'=>'Valider le planning sprint avec l\'équipe','priorite'=>'Important','statut'=>'En cours','responsable'=>'Yassine Morin'],
      ['titre'=>'Préparer la présentation direction','priorite'=>'Urgent','statut'=>'En cours','responsable'=>'Lina Benali'],
      ['titre'=>'Inviter les participants — Comité pilotage','priorite'=>'Normal','statut'=>'Terminee','responsable'=>'Ahmed Karimi'],
    ];
    foreach($tasks as $t) {
      Task::create(array_merge($t,['deadline'=>now()->addDays(rand(1,10))->toDateString()]));
    }

    if(Meeting::where('statut','Terminee')->exists()) {
      $done = Meeting::where('statut','Terminee')->first();
      Decision::create(['meeting_id'=>$done->id,'texte'=>'Validation du budget pour Q2 2026']);
      Decision::create(['meeting_id'=>$done->id,'texte'=>'Recrutement de 2 développeurs prévu pour avril']);
    }
  }
}
