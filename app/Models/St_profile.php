<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class St_profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'st_id', 'company_type', 'industry_id', 'jobtype',
    ];
}
