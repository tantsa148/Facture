<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consommation extends Model
{
    protected $table = 'consommation';

    public $timestamps = false;

    protected $fillable = [
        'idutilisateur',
        'idmois',
        'consommation',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idutilisateur');
    }

    public function mois()
    {
        return $this->belongsTo(Mois::class, 'idmois');
    }
}