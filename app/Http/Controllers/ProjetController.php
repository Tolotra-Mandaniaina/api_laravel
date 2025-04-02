<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function ListProjets()
    {
        $projets = Projet::all();

        return response()->json([
            'projets' => $projets
        ], 200);
    }
}

