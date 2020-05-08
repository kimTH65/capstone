<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class design_form extends Model
{
    protected $fillable = ['design_form_boar_no','design_form_designer','design_form_applicant','design_form_detail','design_form_progress','design_form_name','design_form_phone','design_form_email','design_form_position','design_form_address','design_form_group','date'];
}
