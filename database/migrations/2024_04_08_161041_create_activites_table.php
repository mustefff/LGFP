<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitesTable extends Migration
{
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->integer('temps_jeu');
            $table->string('type_activite');
            $table->unsignedBigInteger('joueur_id');
          
            $table->foreign('joueur_id')->references('id')->on('joueurs');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('activites');
    }
}