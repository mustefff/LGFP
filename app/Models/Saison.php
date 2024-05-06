<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model
{
    protected $table = 'saisons';
    protected $fillable = ['libelle', 'date_debut', 'date_fin'];

    // Définir la relation avec Activite
    public function activites()
    {
        return $this->hasMany(Activite::class, 'saison_id');
    }
}