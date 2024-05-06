<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoueursTable extends Migration
{
    public function up()
    {
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->string('prenom');
            $table->string('nom');
            $table->date('date_naissance');
            $table->text('photo')->nullable();
            $table->integer('taille');
            $table->integer('poids');
            $table->string('nationalite');
            $table->date('debut_carriere');
            $table->string('poste');
            $table->integer('num_maillot');
            $table->unsignedBigInteger('saison_id');
            $table->unsignedBigInteger('equipe_id');
            $table->foreign('saison_id')->references('id')->on('saisons');
            $table->foreign('equipe_id')->references('id')->on('equipes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('joueurs');
    }
}