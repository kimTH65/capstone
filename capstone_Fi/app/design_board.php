<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class design_board extends Model
{
    //----------  new soft-delete ---------------------
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $dates =['deleted_at'];
    //----------  ---------------- ---------------------
     protected $fillable = ['user_id','title','content','subcontent','date'];
}
