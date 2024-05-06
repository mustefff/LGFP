<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games'; // Assurez-vous que le nom de la table est correct
    protected $fillable = ['date', 'heure', 'lieu', 'journee', 'score', 'home_team_id', 'away_team_id', 'stade_id', 'saison_id'];

    public function homeTeam()
    {
        return $this->belongsTo(Equipe::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Equipe::class, 'away_team_id');
    }

    public function stade()
    {
        return $this->belongsTo(Stade::class, 'stade_id');
    }

    public function saison()
    {
        return $this->belongsTo(Saison::class, 'saison_id');
    }
}