<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
         'name', 'email', 'password', 'line_id',
         'email_verified', 'email_verify_token',
         'status',
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

    public function scopeUniversityClassFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('university_class', $tag);
        }
        return $query;
    }
    public function scopeIndustryFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('industry', $tag);
        }
        return $query;
    }
    public function scopeJobtypeFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('jobtype', $tag);
        }
        return $query;
    }
    public function scopeWorkplaceFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('workplace', $tag);
        }
        return $query;
    }
    public function scopeCompanyTypeFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('company_type', $tag);
        }
        return $query;
    }
    public function scopeEnglishLevelFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('english_level', $tag);
        }
        return $query;
    }
    public function scopeToeicFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('toeic', $tag);
        }
        return $query;
    }
    public function scopeStatusFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('status', $tag);
        }
        return $query;
    }
    public function scopeGenderFilter($query, ?string $tag){
        if(!is_null($tag)){
            return $query->where('gender', $tag);
        }
        return $query;
    }

    public function videos()
    {
      return $this->hasMany('App\Models\Video');
    }
}
