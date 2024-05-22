<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestionnairesEquipeTable extends Migration
{
    public function up()
    {
        Schema::create('gestionnaires_equipe', function (Blueprint $table) {
            $table->id();
            $table->string('nationalite');
            $table->unsignedBigInteger('equipe_id');
            $table->foreign('equipe_id')->references('id')->on('equipes');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gestionnaires_equipe');
    }
}