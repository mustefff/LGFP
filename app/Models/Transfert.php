<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
    protected $table = 'transferts';
    protected $fillable = ['num_maillot', 'periode', 'equipe_id', 'joueur_id'];
}