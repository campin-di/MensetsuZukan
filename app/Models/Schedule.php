<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function st_user()
    {
      return $this->belongsTo('App\Models\User', 'st_id');
    }
}
