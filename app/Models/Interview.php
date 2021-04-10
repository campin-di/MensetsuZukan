<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function hr_user()
    {
      return $this->belongsTo('App\Models\HrUser', 'hr_id');
    }

    public function st_user()
    {
      return $this->belongsTo('App\Models\User', 'st_id');
    }

    public function question1()
    {
      return $this->belongsTo('App\Models\Question', 'question_1_id');
    }

    public function question2()
    {
      return $this->belongsTo('App\Models\Question', 'question_2_id');
    }

    public function question3()
    {
      return $this->belongsTo('App\Models\Question', 'question_3_id');
    }

    public function question4()
    {
      return $this->belongsTo('App\Models\Question', 'question_4_id');
    }

    public function question5()
    {
      return $this->belongsTo('App\Models\Question', 'question_5_id');
    }

    public function question6()
    {
      return $this->belongsTo('App\Models\Question', 'question_6_id');
    }
}
