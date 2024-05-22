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
use Illuminate\Support\Facades\Auth;

class ManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
       

        View::composer('gequipe', function ($view) {
          


            $user = Auth::user();
            $userName = $user->prenom ;
            $view->with('userName', $userName);
           
        });


        View::composer('layouts.app_gequipe', function ($view) {
          


            $user = Auth::user();
            $userName = $user->prenom ;
            $view->with('userName', $userName);
           
        });


        
    }
}