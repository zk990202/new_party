<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('twt_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_extension');
            $table->integer('file_size')->unsigned();
            $table->string('file_usage');
            $table->timestamps();
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
        Schema::dropIfExists('twt_files');
    }
}
