<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mois extends Model
{
    protected $table = 'mois';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];
}