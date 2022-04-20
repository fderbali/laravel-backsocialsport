<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CourrielController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\ActiviteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'activite' => ActiviteController::class,
]);
Route::apiResources([
    'membre' => MembreController::class,
]);
Route::post("/membre/login", [MembreController::class, 'login']);

Route::get("/membre/{id}/activite", [MembreController::class, 'getActivites']);
Route::post("membre/check_inscription", [MembreController::class, 'checkInscription']);
Route::post("/membre/inscrire", [MembreController::class, 'inscrire']);
Route::post("/membre/desinscrire", [MembreController::class, 'desinscrire']);
Route::get("/activite/{id}/participant", [ActiviteController::class, 'getParticipants']);
Route::get("/activite/{id}/organisateur", [ActiviteController::class, 'organisateur']);
Route::get("/categorie", [CategorieController::class, 'categories']);

Route::get("/membre/{membre}/courriels", [CourrielController::class, 'courriels']);
Route::get("/membre/{membre}/sentcourriels", [CourrielController::class, 'sentCourriels']);
Route::get("/courriel/{courriel}", [CourrielController::class, 'getCourriel']);
Route::post("sendcourriel", [CourrielController::class, 'sendCourriel']);
Route::get("courriel/{courriel}/mark_as_read", [CourrielController::class, 'markAsRead']);
