<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('twt_manager_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('self_id')->unique();
            $table->integer('parent_id');
            $table->string('name');
            $table->string('url')->default('#');
            $table->string('route')->defalut('#');
            $table->string('icon')->default('fa fa-circle-o');
            $table->tinyInteger('is_show')->default(1);
//            $table->integer('auth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('twt_manager_modules');

    }
}
