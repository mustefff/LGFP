<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfertsTable extends Migration
{
    public function up()
    {
        Schema::create('transferts', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->integer('num_maillot');
            $table->string('duree_contrat')->nullable(); // Exemple: 3 ans
            $table->boolean('examen_medical_reussi')->default(false);
            $table->string('document_contrat')->nullable(); // URL ou chemin vers le document de contrat
            $table->unsignedBigInteger('equipe_id');
            $table->foreign('equipe_id')->references('id')->on('equipes');
            $table->unsignedBigInteger('joueur_id');
            $table->foreign('joueur_id')->references('id')->on('joueurs');
        
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transferts');
    }
}