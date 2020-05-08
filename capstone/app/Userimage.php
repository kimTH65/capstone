<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userimage extends Model
{
    /* 템플릿 제목과 유저 아이디는 반드시 들어가도록 설정*/
    protected $fillable = ['image_title','user_id'];
}
