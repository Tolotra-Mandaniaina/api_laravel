<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    // 
    public function createPersonne(Request $request){
        $request->validate([
            "nom"=>"required",
            "age"=>"required",
            "tel"=>"required|integer",
            "psh"=>"required",
            "email"=>"nullable|email",
            "fb"=>"nullable",
            "organisation"=>"nullable",
            "region"=>"required",
            "codeRegion"=>"required|integer",
            "district"=>"required",
            "codeDistrict"=>"required|integer",
            "commune"=>"required",
            "codeCommune"=>"required|integer",
            "organisation_id" => "required|exists:organisations,id",

        ]);

        $personneCreated = Personne::create([
            "nom"=> $request->nom,
            "age"=> $request->age,
            "tel"=> $request->tel,
            "psh"=>$request->psh,
            "email"=>$request->email ?? null,
            "fb"=>$request->fb ?? null,
            "organisation"=>$request->organisation ?? null,
            "region"=>$request->region,
            "codeRegion"=>$request->codeRegion,
            "district"=>$request->district,
            "codeDistrict"=>$request->codeDistrict,
            "commune"=>$request->commune,
            "codeCommune"=>$request->codeCommune,
            "organisation_id"=>$request->organisation_id

        ]);

        return response([
            "message"=>"personne creer avec success",
            "description"=> $personneCreated
        ]);
    }

    // 🔍 Liste des personnes avec tri et activités associées
    public function ListPersonne()
    {
        $personnes = Personne::with(['activites', 'fonctions', 'organisation:id,sigle']) // Inclure le nom de l'organisation
            ->latest()
            ->get()
            ->map(function ($personne) {
                return [
                    'nom' => $personne->nom,
                    'age' => $personne->age,
                    'tel' => $personne->tel,
                    'psh' => $personne->psh,
                    'email' => $personne->email,
                    'fb' => $personne->fb,
                    'organisation' => $personne->organisation ? $personne->organisation->sigle : null, // Retourne le nom au lieu de ID
                    'region' => $personne->region,
                    'codeRegion' => $personne->codeRegion,
                    'district' => $personne->district,
                    'codeDistrict' => $personne->codeDistrict,
                    'commune' => $personne->commune,
                    'codeCommune' => $personne->codeCommune,
                    'activites' => $personne->activites, // Inclut les activités
                    'fonctions' => $personne->fonctions // Inclut les activités

                ];
            });
    
        return response()->json([
            'allPersonne' => $personnes
        ], 200);
    }
    

        // 🔍 Récupérer une personne avec ses activités associées
        public function getPersonne($id)
        {
            // Récupérer la personne avec les activités associées
            $personne = Personne::with('activites')->find($id);

            // Vérifier si la personne existe
            if (!$personne) {
                return response()->json([
                    'message' => "Cette personne n'existe pas"
                ], 404);
            }

            // Retourner les données formatées
            return response()->json([
                'message' => "Personne récupérée avec succès",
                'data' => [
                    'nom' => $personne->nom,
                    'age' => $personne->age,
                    'tel' => $personne->tel,
                    'psh' => $personne->psh,
                    'email' => $personne->email,
                    'fb' => $personne->fb,
                    'organisation' => $personne->organisation ? $personne->organisation->sigle : null, // Retourne le nom au lieu de ID
                    'region' => $personne->region,
                    'codeRegion' => $personne->codeRegion,
                    'district' => $personne->district,
                    'codeDistrict' => $personne->codeDistrict,
                    'commune' => $personne->commune,
                    'codeCommune' => $personne->codeCommune,
                    'activites' => $personne->activites, // Inclut les activités
                    'fonctions' => $personne->fonctions // Inclut les fonctions
                ]
            ], 200);
        }




    public function deletePersonne($id)
    {
        $personne = Personne::find($id);
    
        if ($personne) {
            $personne->delete();
            return response()->json([
                'message' => "Personne supprime avec succès"
            ], 200);
        }
    
        return response()->json([
            'message' => "Cette personne n'existe pas"
        ], 404);
    }

    public function updatePersonne(Request $request, $id){
        $request->validate([
            "nom"=>"required",
            "age"=>"required",
            "tel"=>"required",
            "psh"=>"required",
            "email"=>"nullable|email",
            "fb"=>"nullable",
            "organisation"=>"nullable",
            "region"=>"required",
            "codeRegion"=>"required|integer",
            "district"=>"required",
            "codeDistrict"=>"required|integer",
            "commune"=>"required",
            "codeCommune"=>"required|integer"
        ]);

        $personne = Personne::find($id);
    
        if ($personne) {
            $personne->update([
               "nom"=> $request->nom,
            "age"=> $request->age,
            "tel"=> $request->tel,
            "psh"=>$request->psh,
            "email"=>$request->email ?? null,
            "fb"=>$request->fb ?? null,
            "organisation"=>$request->organisation ?? null,
            "region"=>$request->region,
            "codeRegion"=>$request->codeRegion,
            "district"=>$request->district,
            "codeDistrict"=>$request->codeDistrict,
            "commune"=>$request->commune,
            "codeCommune"=>$request->codeCommune
            ]);
            return response()->json([
                'message' => "Personne modifier avec succès"
            ], 200);
        }
            return response()->json([
                'message' => "Cette personne n'existe pas"
            ], 404);

    }

       // Méthode pour assigner des fonctions à une personne
       public function assignerFonction(Request $request, $personneId)
       {
           // Validation des données
           $request->validate([
               'fonctions' => 'required|array', // 'fonctions' doit être un tableau
               'fonctions.*' => 'exists:fonctions,id', // Chaque ID de fonction doit exister dans la table 'fonctions'
           ]);
   
           // Récupérer la personne par son ID
           $personne = Personne::findOrFail($personneId);
   
           // Attacher les fonctions sélectionnées à la personne
           $personne->fonctions()->sync($request->input('fonctions'));
   
           // Retourner une réponse JSON avec un message de succès
           return response()->json([
               'message' => 'Fonctions assignées avec succès!',
               'personne' => $personne,
               'assigned_fonctions' => $personne->fonctions,
           ], 200);
       }
    

}
