<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Equipe;
use App\Models\Stade;
use App\Models\Saison;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $equipes = Equipe::all(); // Récupérer toutes les équipes
        $stades = Stade::all(); // Récupérer tous les stades
        $saisons = Saison::all();
        return view('game.index', compact('games', 'equipes' , 'stades','saisons'));
    }

    public function show($id)
    {
        $game = Game::find($id);
        return view('game.show', compact('game'));
    }

    public function create()
{
    $equipes = Equipe::all(); // Récupérer toutes les équipes
    $stades = Stade::all(); // Récupérer tous les stades
    $saisons = Saison::all();
    return view('game.create', compact('equipes', 'stades','saisons'));
}

    public function store(Request $request)
{
    $request->validate([
        'date' => 'required',
        'heure' => 'required',
        'lieu' => 'required',
        'journee' => 'required',
        'stade_id' => 'required',
        'home_team_id' => 'required', // Modification ici
        'away_team_id' => 'required', // Modification ici
        'saison_id' => 'required', // Assurez-vous que ce champ est également géré si nécessaire
    ]);

    Game::create($request->all());

    return redirect()->route('game.index')->with('success', 'Match créé avec succès.');
}

public function edit($id)
{
    $game = Game::find($id);
    $equipes = Equipe::all(); // Récupérer toutes les équipes
    $stades = Stade::all(); // Récupérer tous les stades
    $saisons = Saison::all();
    return view('game.edit', compact('game', 'equipes', 'stades', 'saisons'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'heure' => 'required',
            'lieu' => 'required',
            'journee' => 'required',
            'stade_id' => 'required',
            'home_team_id' => 'required', // Modification ici
            'away_team_id' => 'required', // Modification ici
            'saison_id' => 'required', // Assurez-vous que ce champ est également géré si nécessaire
        ]);
    
        $game = Game::find($id);
        $game->update($request->all());
    
        return redirect()->route('game.index')->with('success', 'Match mis à jour avec succès.');
    }
    
    public function destroy(Request $request, $id)
    {
        try {
            $game = Game::find($id);
            $game->delete();
            return response()->json(['success' => true, 'redirect' => route('game.index')]);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite lors de la suppression du match.']);
        }
    }
    
}