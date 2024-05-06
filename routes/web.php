<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GequipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/gequipe', function () {
    return view('gequipe');
});



use App\Http\Controllers\EquipeController;

// Route pour afficher le formulaire de création d'une nouvelle équipe
Route::get('/equipe/create', [EquipeController::class, 'create'])->name('equipe.create');

// Route pour enregistrer une nouvelle équipe dans la base de données
Route::post('/equipe', [EquipeController::class, 'store'])->name('equipe.store');

// Route pour afficher la liste des équipes
Route::get('/equipe', [EquipeController::class, 'index'])->name('equipe.index');

// Route pour afficher le formulaire d'édition d'une équipe spécifique
Route::get('/equipes/{equipe}/edit', [EquipeController::class, 'edit'])->name('equipe.edit');

// Route pour mettre à jour une équipe spécifique dans la base de données
Route::put('/equipe/{equipe}', [EquipeController::class, 'update'])->name('equipe.update');

// Route pour afficher les détails d'une équipe spécifique
Route::get('/equipe/{equipe}', [EquipeController::class, 'show'])->name('equipe.show');

// Route pour supprimer une équipe spécifique de la base de données
Route::delete('/equipe/{equipe}', [EquipeController::class, 'destroy'])->name('equipe.destroy');




use App\Http\Controllers\SaisonController;

Route::get('/saisons', [SaisonController::class, 'index'])->name('saison.index');
Route::get('/saisons/create', [SaisonController::class, 'create'])->name('saisons.create');
Route::post('/saisons', [SaisonController::class, 'store'])->name('saisons.store');
Route::get('/saisons/{saison}', [SaisonController::class, 'show'])->name('saisons.show');
Route::get('/saisons/{saison}/edit', [SaisonController::class, 'edit'])->name('saisons.edit');
Route::put('/saisons/{saison}', [SaisonController::class, 'update'])->name('saisons.update');
Route::delete('/saisons/{saison}', [SaisonController::class, 'destroy'])->name('saisons.destroy');


use App\Http\Controllers\JoueurController;

Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueurs.index');
//Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueur.index');
Route::get('/joueurs/create', [JoueurController::class, 'create'])->name('joueurs.create');
Route::post('/joueurs', [JoueurController::class, 'store'])->name('joueurs.store');
Route::get('/joueurs/{joueur}', [JoueurController::class, 'show'])->name('joueurs.show');
Route::get('/joueurs/{joueur}/edit', [JoueurController::class, 'edit'])->name('joueurs.edit');
Route::put('/joueurs/{joueur}', [JoueurController::class, 'update'])->name('joueurs.update');
Route::delete('/joueurs/{joueur}', [JoueurController::class, 'destroy'])->name('joueurs.destroy');



use App\Http\Controllers\GameController;

Route::get('/games', [GameController::class, 'index'])->name('game.index');
Route::get('/games/create', [GameController::class, 'create'])->name('game.create');
Route::post('/games', [GameController::class, 'store'])->name('game.store');
Route::get('/games/{id}', [GameController::class, 'show'])->name('game.show');
Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
Route::put('/games/{id}', [GameController::class, 'update'])->name('game.update');
Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('game.destroy');



use App\Http\Controllers\StadeController;

Route::get('/stades', [StadeController::class, 'index'])->name('stade.index');
Route::get('/stades/create', [StadeController::class, 'create'])->name('stade.create');
Route::post('/stades', [StadeController::class, 'store'])->name('stade.store');
Route::get('/stades/{id}/edit', [StadeController::class, 'edit'])->name('stade.edit');
Route::put('/stades/{id}', [StadeController::class, 'update'])->name('stade.update');
Route::delete('/stades/{id}', [StadeController::class, 'destroy'])->name('stade.destroy');



use App\Http\Controllers\ActiviteController;

Route::get('/activites', [ActiviteController::class, 'index'])->name('activite.index');
Route::get('/activites/create', [ActiviteController::class, 'create'])->name('activite.create');
Route::post('/activites', [ActiviteController::class, 'store'])->name('activite.store');
Route::get('/activites/{activite}/edit', [ActiviteController::class, 'edit'])->name('activite.edit');
Route::put('/activites/{activite}', [ActiviteController::class, 'update'])->name('activite.update');
Route::delete('/activites/{activite}', [ActiviteController::class, 'destroy'])->name('activite.destroy');