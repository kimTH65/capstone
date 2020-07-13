<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question_board extends Model
{
     protected $fillable = ['user_id','title','content','date']; //<---- Add this line
}
