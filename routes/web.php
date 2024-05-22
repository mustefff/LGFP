<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GequipeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\SaisonController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\StadeController;
use App\Http\Controllers\ActiviteController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GEquipeMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JoueurManagerController;
use App\Http\Controllers\TransfertController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




 Route::middleware(['auth', AdminMiddleware::class])->group(function () {

    Route::get('/equipe/create', [EquipeController::class, 'create'])->name('equipe.create');
    Route::post('/equipe', [EquipeController::class, 'store'])->name('equipe.store');
    Route::get('/equipe', [EquipeController::class, 'index'])->name('equipe.index');
    Route::get('/equipes/{equipe}/edit', [EquipeController::class, 'edit'])->name('equipe.edit');
    Route::put('/equipe/{equipe}', [EquipeController::class, 'update'])->name('equipe.update');
    Route::get('/equipe/{equipe}', [EquipeController::class, 'show'])->name('equipe.show');
    Route::delete('/equipe/{equipe}', [EquipeController::class, 'destroy'])->name('equipe.destroy');


    Route::get('/saisons', [SaisonController::class, 'index'])->name('saison.index');
    Route::get('/saisons/create', [SaisonController::class, 'create'])->name('saisons.create');
    Route::post('/saisons', [SaisonController::class, 'store'])->name('saisons.store');
    Route::get('/saisons/{saison}', [SaisonController::class, 'show'])->name('saisons.show');
    Route::get('/saisons/{saison}/edit', [SaisonController::class, 'edit'])->name('saisons.edit');
    Route::put('/saisons/{saison}', [SaisonController::class, 'update'])->name('saisons.update');
    Route::delete('/saisons/{saison}', [SaisonController::class, 'destroy'])->name('saisons.destroy');


    Route::get('/joueurs', [JoueurController::class, 'index'])->name('joueurs.index');
    Route::get('/joueurs/create', [JoueurController::class, 'create'])->name('joueurs.create');
    Route::post('/joueurs', [JoueurController::class, 'store'])->name('joueurs.store');
    Route::get('/joueurs/{joueur}', [JoueurController::class, 'show'])->name('joueurs.show');
    Route::get('/joueurs/{joueur}/edit', [JoueurController::class, 'edit'])->name('joueurs.edit');
    Route::put('/joueurs/{joueur}', [JoueurController::class, 'update'])->name('joueurs.update');
    Route::delete('/joueurs/{joueur}', [JoueurController::class, 'destroy'])->name('joueurs.destroy');


    Route::get('/games', [GameController::class, 'index'])->name('game.index');
    Route::get('/games/create', [GameController::class, 'create'])->name('game.create');
    Route::post('/games', [GameController::class, 'store'])->name('game.store');
    Route::get('/games/{id}', [GameController::class, 'show'])->name('game.show');
    Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('game.edit');
    Route::put('/games/{id}', [GameController::class, 'update'])->name('game.update');
    Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('game.destroy');


    Route::get('/stades', [StadeController::class, 'index'])->name('stade.index');
    Route::get('/stades/create', [StadeController::class, 'create'])->name('stade.create');
    Route::post('/stades', [StadeController::class, 'store'])->name('stade.store');
    Route::get('/stades/{id}/edit', [StadeController::class, 'edit'])->name('stade.edit');
    Route::put('/stades/{id}', [StadeController::class, 'update'])->name('stade.update');
    Route::delete('/stades/{id}', [StadeController::class, 'destroy'])->name('stade.destroy');

    
    Route::get('/activites', [ActiviteController::class, 'index'])->name('activite.index');
    Route::get('/activites/create', [ActiviteController::class, 'create'])->name('activite.create');
    Route::post('/activites', [ActiviteController::class, 'store'])->name('activite.store');
    Route::get('/activites/{activite}/edit', [ActiviteController::class, 'edit'])->name('activite.edit');
    Route::put('/activites/{activite}', [ActiviteController::class, 'update'])->name('activite.update');
    Route::delete('/activites/{activite}', [ActiviteController::class, 'destroy'])->name('activite.destroy');
    // Autres routes nécessitant l'authentification en tant qu'administrateur

    Route::get('/admin/gestionnairesEquipe', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/createGequipe', [AdminController::class, 'showCreateForm'])->name('admin.showCreateForm');
    Route::post('/admin/createGequipe', [AdminController::class, 'create'])->name('admin.create');

    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}/delete', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
   
});


Route::get('/admin/transferts', [AdminController::class, 'showTransferts'])->name('admin.transferts');
Route::post('/admin/transferts/{id}/approve', [AdminController::class, 'approveTransfert'])->name('admin.transferts.approve');
Route::post('/admin/transferts/{id}/reject', [AdminController::class, 'rejectTransfert'])->name('admin.transferts.reject');

Route::get('/test-view', function () {
    return view('test');
});


Route::middleware(['auth', GEquipeMiddleware::class])->group(function () {

    Route::get('/gequipe', [GequipeController::class, 'show'])->name('gequipe')->middleware('auth');

    Route::get('/joueur', [JoueurManagerController::class, 'index'])->name('mjoueurs.index');
    Route::get('/joueur/{joueur}/edit', [JoueurManagerController::class, 'edit'])->name('mjoueur.edit');
    Route::put('/joueur/{joueur}', [JoueurManagerController::class, 'update'])->name('joueur.update');      
    Route::get('/mjoueurs/all-info', [JoueurManagerController::class, 'getAllInfo'])->name('mjoueurs.getAllInfo');
    Route::get('/mjoueurs/{joueur}/details', [JoueurManagerController::class, 'showDetails'])->name('mjoueurs.showDetails');
    Route::post('mjoueurs/transfert', [JoueurManagerController::class, 'proposeTransfert'])->name('mjoueurs.proposeTransfert');
    Route::get('mjoueurs/transfert', [JoueurManagerController::class, 'showTransfertForm'])->name('mjoueurs.showTransfertForm');

    Route::get('mjoueurs/transferts/received', [JoueurManagerController::class, 'receivedTransferts'])->name('mjoueurs.receivedTransferts');
    Route::post('mjoueurs/transferts/{transfert}/accept', [JoueurManagerController::class, 'acceptTransfert'])->name('mjoueurs.acceptTransfert');
    Route::post('mjoueurs/transferts/{transfert}/refuse', [JoueurManagerController::class, 'refuseTransfert'])->name('mjoueurs.refuseTransfert');
    Route::get('mjoueurs/transferts/{transfert}/edit', [JoueurManagerController::class, 'editTransfert'])->name('transferts.edit');
    Route::put('mjoueurs/transferts/{transfert}', [JoueurManagerController::class, 'updateTransfert'])->name('transferts.update');
    Route::delete('mjoueurs/transferts/{transfert}', [JoueurManagerController::class, 'destroy'])->name('transferts.destroy');

    Route::put('/mjoueurs/transfert/{id}', [JoueurManagerController::class, 'updateTransfert'])->name('transfert.update');
    Route::delete('/mjoueurs/transfert/{id}', [JoueurManagerController::class, 'destroy'])->name('transfert.destroy');
    Route::get('mjoueurs/transferts/sent', [JoueurManagerController::class, 'sentTransferts'])->name('mjoueurs.sentTransferts');

   

//Route::resource('transfert', TransfertController::class);

});

// routes/web.php

Route::post('/login', [LoginController::class, 'login'])->name('login.custom');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');