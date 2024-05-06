<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Equipe;
use App\Models\Joueur;
use App\Models\Game;

class DynamicDataServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.app_admin', function ($view) {
            $equipesCount = Equipe::count();
            $joueursCount = Joueur::count();
            $gamesCount = Game::count();

            $view->with('equipesCount', $equipesCount)
                 ->with('joueursCount', $joueursCount)
                 ->with('gamesCount', $gamesCount);
        });
    }
}