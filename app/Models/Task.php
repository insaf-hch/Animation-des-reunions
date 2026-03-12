<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Task extends Model {
  protected $fillable = ['meeting_id','responsable','titre','priorite','deadline','statut'];
  public function meeting() { return $this->belongsTo(Meeting::class); }
}
