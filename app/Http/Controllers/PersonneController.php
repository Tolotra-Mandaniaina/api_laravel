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
            "tel"=>"required",
            "psh"=>"required",
            "email"=>"nullable|email",
            "fb"=>"nullable",
            "fonction"=>"nullable",
            "organisation"=>"nullable",
            "region"=>"required",
            "codeRegion"=>"required|integer",
            "district"=>"required",
            "codeDistrict"=>"required|integer",
            "commune"=>"required",
            "codeCommune"=>"required|integer"
        ]);

        $personneCreated = Personne::create([
            "nom"=> $request->nom,
            "age"=> $request->age,
            "tel"=> $request->tel,
            "psh"=>$request->psh,
            "email"=>$request->email ?? null,
            "fb"=>$request->fb ?? null,
            "fonction"=>$request->fonction ?? null,
            "organisation"=>$request->organisation ?? null,
            "region"=>$request->region,
            "codeRegion"=>$request->codeRegion,
            "district"=>$request->district,
            "codeDistrict"=>$request->codeDistrict,
            "commune"=>$request->commune,
            "codeCommune"=>$request->codeCommune
        ]);

        return response([
            "message"=>"personne creer avec success",
            "description"=> $personneCreated
        ]);
    }

    public function ListPersonne(){
        return response([
            'allPersonne' => Personne::get()
        ]);
    }

    public function getPersonne($id)
    {
        $personne = Personne::find($id);

        if (!$personne) {
            return response()->json([
                'message' => "Cette personne n'existe pas"
            ], 404);
        }

        return response()->json([
            'message' => "Personne récupérée avec succès",
            'data' => $personne
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
            "fonction"=>"nullable",
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
            "fonction"=>$request->fonction ?? null,
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
    

}
