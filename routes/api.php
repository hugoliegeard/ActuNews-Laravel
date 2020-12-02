<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * En déclarant cette route, Laravel va gérer automatiquement tous les types de requêtes...
 * Une déclaration pour plusieurs requètes. (C.R.U.D)
 * ex. GET, POST, PUT, PATCH, DELETE
 */
Route::apiResource('posts', \App\Http\Controllers\Api\PostController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Nous déclarons une route permettant de générer
 * pour l'utilisateur un TOKEN d'authentification.
 * -----------------------------------------------
 * Ce TOKEN sera ensuite utilisé dans chaque requête
 * pour autoriser la requête de l'utilisateur.
 * -----------------------------------------------
 * NB : Le serveur vérifie a chaque requête la
 * validité du TOKEN pour autorisé la requête.
 * -----------------------------------------------
 * cf : https://laravel.com/docs/5.8/api-authentication
 */
Route::post('/sanctum/token', function (Request $request) {

    # 1. On demande à l'utilisateur les informations suivantes : email, password, device_name
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    # 2. On récupère l'utilisateur par rapport à son email
    $user = \App\Models\User::where('email', $request->email)->first();

    # 3. Vérification du mot de passe
    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => ['Identifiant / Mot de passe incorrect.']
        ]);
    }

    # 4. On retourne à l'utilisateur un TOKEN
    return $user->createToken($request->device_name)->plainTextToken;

});
