<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Decision extends Model {
  protected $fillable = ['meeting_id','texte'];
  public function meeting() { return $this->belongsTo(Meeting::class); }
}
