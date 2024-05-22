<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTransfertsTable extends Migration
{
    public function up()
    {
        Schema::table('transferts', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Statuts possibles : pending, accepted_by_team, approved_by_admin, rejected
        });
    }

    public function down()
    {
        Schema::table('transferts', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
