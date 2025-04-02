<?php

use App\Models\Activite;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\FichePresenceController;
use App\Http\Controllers\ProjetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 
*/


//ROUTE DES PERSONNES
Route::post("/personnes",[PersonneController::class, 'createPersonne']);
Route::get("/personnes",[PersonneController::class, 'ListPersonne']);
Route::get("/personnes/{id}",[PersonneController::class, 'getPersonne']);
Route::delete("/personnes/{id}",[PersonneController::class, 'deletePersonne']);
Route::put("/personnes/{id}",[PersonneController::class, 'updatePersonne']);
Route::post('/personnes/{personneId}/assigner-fonction', [PersonneController::class, 'assignerFonction']);
Route::get('/personnes/activite/{activity_id}', [PersonneController::class, 'listPersonnesByActivite']);

//ROUTE DES ACTIVITES
Route::post("/activites",[ActiviteController::class, 'createActivite']);
Route::post('/activites/{activiteId}/presences', [FichePresenceController::class, 'assignPresence']);
Route::get("/activites",[ActiviteController::class, 'ListActivites']);
Route::get("/activites/{id}",[ActiviteController::class, 'getActivite']);
Route::middleware('auth:sanctum')->get('/activites-user', [ActiviteController::class, 'ListactivitesByUser']);



//ROUTE DES ORGANISATIONS
Route::post("/organisations", [OrganisationController::class, 'createOrganisation']);
Route::get("/organisations", [OrganisationController::class, 'ListOrganisations']);


Route::get("/projets", [ProjetController::class, 'ListProjets']);


//ROUTE DES USERS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
}); 