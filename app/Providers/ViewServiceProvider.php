<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Activite;
use App\Models\Game;
use App\Models\Stade;
use App\Models\Saison;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.app_admin', function ($view) {
            $equipeCount = Equipe::count();
            $view->with('equipeCount', $equipeCount);
            $joueurCount = Joueur::count();
            $view->with('joueurCount', $joueurCount);
            $gameCount = Game::count();
            $view->with('gameCount', $gameCount);

            $latestPlayers = Joueur::latest()->take(5)->get();
            $newPlayersCount = Joueur::where('created_at', '>', now()->subDay())->count(); // Compter les joueurs créés dans les dernières 24 heures

            $view->with(compact('latestPlayers', 'newPlayersCount'));
        });

        View::composer('dashboard', function ($view) {
            $equipeCount = Equipe::count();
            $view->with('equipeCount', $equipeCount);
            $joueurCount = Joueur::count();
            $view->with('joueurCount', $joueurCount);
            $gameCount = Game::count();
            $view->with('gameCount', $gameCount);
            $stadeCount = Stade::count();
            $view->with('stadeCount', $stadeCount);
            $saisonCount = Saison::count();
            $view->with('saisonCount', $saisonCount);
            $saisons = Saison::all(); // Récupérer toutes les saisons

            $butsParSaison = Saison::withCount(['activites' => function ($query) {
                $query->where('type_activite', 'but');
            }])->get();
            $view->with(compact('equipeCount', 'joueurCount', 'gameCount', 'stadeCount', 'saisonCount', 'butsParSaison','saisons'));

           
            $ageMoyenParEquipe = Equipe::with(['joueurs' => function($query) {
                $query->select(
                    'equipe_id',
                    DB::raw('AVG(TIMESTAMPDIFF(YEAR, date_naissance, CURDATE())) as average_age'),
                    DB::raw('COUNT(*) as player_count')
                )->groupBy('equipe_id');
            }])->get();

            $view->with('ageMoyenParEquipe', $ageMoyenParEquipe);

            $ageMoyenParEquipeEtSaison = Equipe::with(['joueurs' => function($query) {
                $query->select(
                    'equipe_id',
                    'saison_id',
                    DB::raw('AVG(TIMESTAMPDIFF(YEAR, date_naissance, CURDATE())) as average_age'),
                    DB::raw('COUNT(*) as player_count')
                )->groupBy('equipe_id', 'saison_id');
            }])->get();

            
            $view->with('ageMoyenParEquipeEtSaison', $ageMoyenParEquipeEtSaison);

            $latestPlayers = Joueur::latest()->take(5)->get();
            $newPlayersCount = Joueur::where('created_at', '>', now()->subDay())->count(); // Compter les joueurs créés dans les dernières 24 heures

            $view->with(compact('latestPlayers', 'newPlayersCount'));
           
        });

        
    }
}