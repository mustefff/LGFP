<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'date_naissance',
        'photo',
        'taille',
        'poids',
        'nationalite',
        'debut_carriere',
        'poste',
        'num_maillot',
        'description',
        'dribbles',
        'passes',
        'duel',
        'tirs_bloques',
        'interception',
        'abord',
        'recouvrement',
        'dernier_homme',
        'degagement',
        'saison_id',
        'equipe_id',
    ];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    public function saison()
    {
        return $this->belongsTo(Saison::class);
    }
}