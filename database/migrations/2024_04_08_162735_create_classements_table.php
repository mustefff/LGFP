<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassementsTable extends Migration
{
    public function up()
    {
        Schema::create('classements', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->integer('nombre_points');
            $table->integer('nombre_match');
            $table->unsignedBigInteger('saison_id');
            $table->unsignedBigInteger('equipe_id');
            $table->foreign('saison_id')->references('id')->on('saisons');
            $table->foreign('equipe_id')->references('id')->on('equipes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classements');
    }
}