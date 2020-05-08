<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('design_form_boar_no');
            $table->char('design_form_designer',30);
            $table->char('design_form_applicant',30);
            $table->text('design_form_detail');
            $table->char('design_form_progress',30);
            $table->char('design_form_name',30);
            $table->char('design_form_phone',30);
            $table->char('design_form_email',30);
            $table->char('design_form_position',30);
            $table->char('design_form_address',30);
            $table->char('design_form_group',30);
            $table->dateTime('date');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('design_forms');
    }
}
