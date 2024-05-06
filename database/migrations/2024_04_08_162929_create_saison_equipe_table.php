<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaisonEquipeTable extends Migration
{
    public function up()
    {
        Schema::create('saison_equipe', function (Blueprint $table) {
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->unsignedBigInteger('saison_id');
            $table->unsignedBigInteger('equipe_id');
            $table->foreign('saison_id')->references('id')->on('saisons');
            $table->foreign('equipe_id')->references('id')->on('equipes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('saison_equipe');
    }
}