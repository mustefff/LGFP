<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadesTable extends Migration
{
    public function up()
    {
        Schema::create('stades', function (Blueprint $table) {
            $table->id();
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->string('nom');
            $table->string('emplacement');
            $table->integer('capacite');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stades');
    }
}