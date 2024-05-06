<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    protected $table = 'activites';
    protected $fillable = ['temps_jeu', 'type_activite', 'game_id', 'joueur_id', 'saison_id'];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'joueur_id');
    }

    public function saison()
    {
        return $this->belongsTo(Saison::class, 'saison_id');
    }
}