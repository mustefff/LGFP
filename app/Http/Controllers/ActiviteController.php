<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Game;
use App\Models\Joueur;
use App\Models\Saison;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function index()
    {
        $activites = Activite::all();
        return view('activite.index', compact('activites'));
    }

    public function show($id)
    {
        $activite = Activite::find($id);
        return view('activite.show', compact('activite'));
    }

    public function butsParSaison()
{
    $saisons = Saison::withCount(['activites' => function ($query) {
        $query->where('type_activite', 'but');
    }])->get();

    return view('activite.buts_par_saison', compact('saisons'));
}

    public function create()
    {
        $joueurs = Joueur::all(); // Récupérer toutes les saisons
        $games = Game::all();
        $saisons = Saison::all();
        return view('activite.create',['joueurs' => $joueurs, 'games' => $games, 'saisons' => $saisons]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'temps_jeu' => 'required',
            'type_activite' => 'required',
            'game_id' => 'required',
            'joueur_id' => 'required',
            'saison_id' => 'required',
        ]);

        Activite::create($request->all());

        return redirect()->route('activite.index')->with('success', 'Activité créée avec succès.');
    }

    public function edit($id)
    {
        $activite = Activite::find($id);
        $joueurs = Joueur::all(); // Récupérer toutes les saisons
        $games = Game::all();
        $saisons = Saison::all();
        return view('activite.edit', compact('activite','joueurs','games','saisons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'temps_jeu' => 'required',
            'type_activite' => 'required',
            'game_id' => 'required',
            'joueur_id' => 'required',
            'saison_id' => 'required',
        ]);

        $activite = Activite::find($id);
        $activite->update($request->all());

        return redirect()->route('activite.index')->with('success', 'Activité mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $activite = Activite::find($id);
        $activite->delete();

        return redirect()->route('activite.index')->with('success', 'Activité supprimée avec succès.');
    }
}