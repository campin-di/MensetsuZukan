<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function hrUser()
    {
      return $this->belongsTo('App\Models\HrUser');
    }

    public function question()
    {
      return $this->belongsTo('App\Models\Question');
    }
}
