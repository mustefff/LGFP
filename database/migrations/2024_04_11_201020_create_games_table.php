<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->date('date');
            $table->time('heure');
            $table->string('lieu');
            $table->string('journee');
            $table->string('score')->nullable();
            $table->unsignedBigInteger('stade_id');
           
            $table->unsignedBigInteger('saison_id');
            
            $table->foreign('stade_id')->references('id')->on('stades');
            
            $table->foreign('saison_id')->references('id')->on('saisons');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
}