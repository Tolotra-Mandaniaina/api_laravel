<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    public function createOrganisation(Request $request)
    {
        $request->validate([
            "denomination" => "required",
            "sigle" => "required",
            "statut" => "required",
            "anneeConstitution" => "required", 
            "numeroEnregistrement" => "nullable", 
            "region" => "required",
            "codeRegion" => "required|integer",
            "district" => "required",
            "codeDistrict" => "required|integer",
            "commune" => "required",
            "codeCommune" => "required|integer",
            "adresse" => "required",
            "siteWeb" => "nullable",
            "fb" => "nullable",
            "email" => "nullable|email",
            "tel" => "required",

        ]);

        if (!$request) {
            return response()->json(['error' => 'Validation failed'], 422);
        }

        $organisationCreated = Organisation::create([
            "denomination" => $request->denomination,
            "sigle" => $request->sigle,
            "statut" => $request->statut,
            "anneeConstitution" => $request->anneeConstitution, // Validation ajoutée pour que la date de début soit avant ou égale à la date de fin
            "numeroEnregistrement" => $request->numeroEnregistrement, // Validation ajoutée pour que la date de fin soit après ou égale à la date de début
            "region" => $request->region,
            "codeRegion" => $request->codeRegion,
            "district" => $request->district,
            "codeDistrict" => $request->codeDistrict,
            "commune" => $request->commune,
            "codeCommune" => $request->codeCommune,
            "adresse" => $request->adresse,
            "siteWeb" => $request->siteWeb,
            "fb" => $request->fb,
            "email" => $request->email,
            "tel" => $request->tel,
        ]);

        return response([
            "message" => "Organisation créée avec succès",
            "organisation" => $organisationCreated
        ], 201); // Code de statut 201 pour "Créé avec succès"
    }

    public function ListOrganisations()
    {
        $organisations = Organisation::all();

        return response()->json([
            'organisations' => $organisations
        ], 200);
    }

}
