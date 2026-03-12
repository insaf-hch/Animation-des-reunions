<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Meeting extends Model {
  protected $fillable = ['titre','type','lieu','date_reunion','heure_debut','duree','statut','priorite','lien_reunion','createur_id'];
  public function participants() { return $this->hasMany(Participant::class); }
  public function agendas()      { return $this->hasMany(Agenda::class); }
  public function decisions()    { return $this->hasMany(Decision::class); }
  public function tasks()        { return $this->hasMany(Task::class); }
  public function notes()        { return $this->hasMany(Note::class); }
  public function createur()     { return $this->belongsTo(User::class,'createur_id'); }
}
