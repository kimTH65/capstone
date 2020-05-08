<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_tables', function (Blueprint $table) {
            $table->char('user_id',30);
            $table->char('template_title',30);
            $table->char('template_title_text',50);
            $table->char('template_title_small',50);
            $table->char('template_intro_text',50);
            $table->mediumText('template_memo_text');
           $table->char('template_tel',50);
            $table->char('template_email',50);
            $table->char('template_fax',50);
            $table->char('template_info_title',50);
            $table->mediumText('template_info_text');
            $table->char('template_location',30);
            
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_tables');
    }
}
