<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class home extends Model
{
   /* 유저아이디, 비밀번호, 닉네임, 직업은 반드시 들어가도록 설정 */
    protected $fillable = ['user_id','user_pw','user_nick','user_job'];
}
