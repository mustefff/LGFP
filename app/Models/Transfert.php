<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
     const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED_BY_TEAM = 'accepted_by_team';
    const STATUS_APPROVED_BY_ADMIN = 'approved_by_admin';
    const STATUS_REJECTED = 'rejected';
    protected $table = 'transferts';
    protected $fillable = [
        'num_maillot',
        'duree_contrat',
        'examen_medical_reussi',
        'document_contrat',
        'equipe_id',
        'joueur_id',
        'status',
    ];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

    public function joueur()
    {
        return $this->belongsTo(Joueur::class);
    }

}