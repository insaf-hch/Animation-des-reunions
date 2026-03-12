<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Note extends Model {
  protected $fillable = ['meeting_id','contenu'];
  public function meeting() { return $this->belongsTo(Meeting::class); }
}
