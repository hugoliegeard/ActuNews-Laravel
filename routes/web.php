<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function() {
//    return "Accueil";
//});

//Route::get('/contact', function() {
//    return "Contact";
//});

// exemple : http://localhost:8000/
Route::get('/', [DefaultController::class, 'home'])->name('default.home');

// exemple : http://localhost:8000/politique
Route::get('/{alias}', [DefaultController::class, 'category'])->name('default.category');

// exemple : http://localhost:8000/politique/emmanuel-macron-donne-sa-demission-lol_12564.html
Route::get('/{category}/{alias}_{id}.html', [DefaultController::class, 'post'])->name('default.post');

// exemple : http://localhost:8000/page/contact
Route::get('/page/contact', [ContactController::class, 'contact'])->name('contact.contact');

// exemple : http://localhost:8000/page/test/insertion
Route::get('/page/test/insertion', [PostController::class, 'testInsertion']);

// Ici toutes nos routes font appel au middleware d'authentification
// cf: https://laravel.com/docs/8.x/routing#route-group-middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'postsManagement'])->name('admin.posts');

    // Créer un article
    Route::get('/admin/article', [PostController::class, 'create'])->name('post.create');
    Route::post('/admin/article', [PostController::class, 'store'])->name('post.store');

    // Editer un article
    Route::get('/admin/article/{id}', [PostController::class, 'update'])->name('post.update');
    Route::patch('/admin/article/{id}', [PostController::class, 'storeUpdate'])->name('post.store.update');
});

// On réécrit l'URL d'inscription par défaut fourni avec Jetstream
Route::middleware(['guest'])->get('/abonne/inscription', function () {
    return view('auth.register');
})->name('subscriber.register');

// L'URL permettant à un utilisateur connecté d'accéder au panneau d'administration
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/jetstream/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
