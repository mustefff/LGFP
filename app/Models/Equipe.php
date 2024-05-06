<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $table = 'equipes';
    protected $fillable = ['nom', 'photo', 'ville', 'budget'];

    // Définir la relation avec Joueur
    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'equipe_id');
    }
}