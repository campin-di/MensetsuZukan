<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrUser extends Model
{
    use HasFactory;

    protected $fillable = [
      
    ];

    public function videos()
    {
      return $this->hasMany('App\Models\Video');
    }


}
