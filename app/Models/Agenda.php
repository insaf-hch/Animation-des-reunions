<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Agenda extends Model {
  protected $fillable = ['meeting_id','titre','duree','ordre','statut'];
  public function meeting() { return $this->belongsTo(Meeting::class); }
}
