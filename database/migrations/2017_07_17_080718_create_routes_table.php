<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

//        Schema::create('route_groups', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('parent_id')->unsigned()->default(0);
//            $table->string('options')->nullable();
//            $table->string('desc')->nullable();
//        });
//
//        Schema::create('routes', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('group_id')->unsigned();
//            $table->foreign('group_id')->references('id')->on('route_groups')
//                ->onUpdate('cascade')->onDelete('cascade');
//            $table->string('name');
//            $table->string('url');
//            $table->string('method');
//            $table->string('action');
//            $table->string('desc');
//        });

        Schema::create('twt_manager_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('self_id')->unique();
            $table->integer('parent_id');
            $table->string('route_name')->nullable();
            $table->string('url')->nullable();
            $table->string('name');
            $table->string('icon')->default('fa fa-circle-o');
            $table->tinyInteger('is_show')->default(1);
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
        //
        Schema::dropIfExists('twt_manager_modules');
    }
}
