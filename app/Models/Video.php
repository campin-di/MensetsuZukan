<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = "videos";
    protected $fillable = ["thumbnail_name","thumbnail_path"];

    public function user()
    {
      return $this->belongsTo('App\Models\User', 'st_id');
    }

    public function hrUser()
    {
      return $this->belongsTo('App\Models\HrUser', 'hr_id');
    }

    public function question()
    {
      return $this->belongsTo('App\Models\Question');
    }
}
