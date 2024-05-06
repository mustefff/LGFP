<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stade extends Model
{
    protected $table = 'stades';
    protected $fillable = ['nom', 'emplacement', 'capacite'];
}