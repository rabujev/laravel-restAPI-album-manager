<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Albums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('albums', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('name');
    $table->string('file');
    $table->string('gender');
    $table->year('year');
    $table->string('label');
    $table->string('note');
    $table->string('artists');
    $table->string('songs');
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
      Schema::dropIfExists('albums');

    }
}
