<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class design_board extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $fillable = ['user_id','title','content','subcontent','date','vector'];
    protected $dates =['deleted_at'];
}
