<?php

use App\Models\Activite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\FichePresenceController;

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
Route::post("/personnes",[PersonneController::class, 'createPersonne']);
Route::middleware(['auth:sanctum', 'role:admin'])->get("/personnes",[PersonneController::class, 'ListPersonne']);
Route::get("/personnes/{id}",[PersonneController::class, 'getPersonne']);
Route::delete("/personnes/{id}",[PersonneController::class, 'deletePersonne']);
Route::put("/personnes/{id}",[PersonneController::class, 'updatePersonne']);

Route::post("/activites",[ActiviteController::class, 'createActivite']);
Route::post('/activites/{activiteId}/presences', [FichePresenceController::class, 'assignPresence']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
}); 