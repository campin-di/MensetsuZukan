<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrUser extends Model
{
    use HasFactory;

    protected $table = 'hr_users';

    public function videos()
    {
      return $this->hasMany('App\Models\Video');
    }

    public function interviews()
    {
      return $this->hasMany('App\Models\Interview');
    }

}
