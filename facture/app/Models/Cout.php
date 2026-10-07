<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cout extends Model
{
    protected $table = 'cout';

    public $timestamps = false;

    protected $fillable = [
        'idmois',
        'annee',
        'cout',
    ];

    /**
     * Relation avec le mois.
     */
    public function mois()
    {
        return $this->belongsTo(Mois::class, 'idmois');
    }
}
