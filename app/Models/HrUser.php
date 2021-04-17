<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class HrUser extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //$guarded は変更できないカラム
    protected $guarded = [
      'details_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'hr_users';

    public function videos()
    {
      return $this->hasMany('App\Models\Video');
    }

    public function interviews()
    {
      return $this->hasMany('App\Models\Interview');
    }

    public function company()
    {
      return $this->belongsTo('App\Models\Company');
    }

}
