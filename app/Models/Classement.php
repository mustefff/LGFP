<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    protected $table = 'classements';
    protected $fillable = ['nombre_points', 'nombre_match', 'saison_id', 'equipe_id'];
}