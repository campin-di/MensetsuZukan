<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hr_profile extends Model
{
    use HasFactory;

    public function hr_user()
    {
      return $this->hasone('App\Models\HrUser', 'id');
    }
}
