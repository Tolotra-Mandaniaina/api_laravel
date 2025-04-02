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

    public function Listactivites()
    {
        $activites = Activite::all();

        return response()->json([
            'activites' => $activites
        ], 200);
    }

    public function ListactivitesByUser(Request $request)
    {
        // Vérification que l'utilisateur est authentifié
        $user = auth()->user(); // Récupérer l'utilisateur authentifié (via le token)

        // Récupérer les activités associées à l'utilisateur
        $activites = Activite::where('user_id', $user->id)->get();

        // Retourner la réponse JSON avec la liste des activités
        return response()->json([
            'activites' => $activites
        ], 200);
    }


    public function getActivite($id)
    {
        // Rechercher l'activité par ID
        $activite = Activite::find($id);

        // Vérifier si l'activité existe
        if (!$activite) {
            return response()->json([
                "message" => "Activité non trouvée"
            ], 404);
        }

        // Retourner l'activité en format JSON
        return response()->json([
            "activite" => $activite
        ], 200);
    }

}
