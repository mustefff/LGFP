<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestionnaireEquipe extends Model
{
    protected $table = 'gestionnaires_equipe';

    protected $fillable = [
        'nationalite',
        'equipe_id',
        'user_id',
    ];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}