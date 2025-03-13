<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function createActivite(Request $request)
    {
        $request->validate([
            "nom" => "required",
            "description" => "required",
            "dateDebut" => "required|date|before_or_equal:dateFin", // Validation ajoutée pour que la date de début soit avant ou égale à la date de fin
            "dateFin" => "required|date|after_or_equal:dateDebut", // Validation ajoutée pour que la date de fin soit après ou égale à la date de début
            "lieu" => "required",
            "projet_id" => "required|exists:projets,id",
        ]);

        $activiteCreated = Activite::create([
            "nom" => $request->nom,
            "description" => $request->description,
            "dateDebut" => $request->dateDebut,
            "dateFin" => $request->dateFin,
            "lieu" => $request->lieu,
            "projet_id" => $request->projet_id,
        ]);

        return response([
            "message" => "Activité créée avec succès",
            "activite" => $activiteCreated
        ], 201); // Code de statut 201 pour "Créé avec succès"
    }
}
