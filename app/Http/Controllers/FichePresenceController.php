<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use Illuminate\Http\Request;
use App\Models\Personne;
use App\Models\FichePresence;

class FichePresenceController extends Controller
{
    //
    public function assignPresence(Request $request, $activiteId)
    {
        // Valider les données d'entrée
        $request->validate([
            'personnes' => 'required|array', // Un tableau de personnes
            'personnes.*' => 'exists:personnes,id', // Assurer que chaque ID de personne existe
            'est_present' => 'required|boolean', // Indique si la personne est présente ou absente
        ]);

        // Vérifier si l'activité existe
        $activite = Activite::findOrFail($activiteId);

        // Créer ou mettre à jour les fiches de présence
        $fichePresences = [];
        foreach ($request->personnes as $personneId) {
            // Créer ou mettre à jour la fiche de présence
            $fichePresence = FichePresence::updateOrCreate(
                [
                    'personne_id' => $personneId,
                    'activite_id' => $activiteId
                ],
                [
                    'est_present' => $request->est_present // Mettre à jour l'état de présence
                ]
            );

            // Ajouter chaque fiche de présence dans le tableau pour la réponse
            $fichePresences[] = $fichePresence;
        }

        // Retourner une réponse de succès avec les données créées
        return response()->json([
            'message' => 'Présences assignées avec succès.',
            'fiche_presences' => $fichePresences, // Retourner les fiches de présence créées ou mises à jour
        ]);
    }
}
