<?php

namespace App\Http\Controllers;

use App\Models\Mois;

class MoisController extends Controller
{
    public function index()
    {
        $mois = Mois::all();

        return view('mois.index', compact('mois'));
    }
}