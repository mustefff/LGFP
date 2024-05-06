<?php

namespace App\Http\Controllers;

use App\Models\Joueur;
use App\Models\Saison; // Assurez-vous d'importer le modèle Saison
use App\Models\Equipe; // Assurez-vous d'importer le modèle Equipe
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JoueurController extends Controller
{
    public function index()
    {
        $joueurs = Joueur::all();
        $joueurs = Joueur::with('equipe', 'saison')->get();
    
        return view('joueur.index', compact('joueurs'));
    }

    public function show($id)
    {
        $joueur = Joueur::find($id);
        return view('joueur.show', compact('joueur'));
    }

    public function create()
    {
        $saisons = Saison::all(); // Récupérer toutes les saisons
        $equipes = Equipe::all(); // Récupérer toutes les équipes

        return view('joueur.create', ['saisons' => $saisons, 'equipes' => $equipes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'date_naissance' => 'required',
            'nationalite' => 'required',
            'poste' => 'required',
            'saison_id' => 'required',
            'equipe_id' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
             // Validation de l'image
        ]);

        $joueur = new Joueur();
        $joueur->prenom = $request->prenom;
        $joueur->nom = $request->nom;
        $joueur->date_naissance = $request->date_naissance;
        $joueur->taille = $request->taille;
        $joueur->poids = $request->poids;
        $joueur->nationalite = $request->nationalite;
        $joueur->debut_carriere = $request->debut_carriere;
        $joueur->poste = $request->poste;
        $joueur->num_maillot = $request->num_maillot;
        $joueur->saison_id = $request->saison_id;
        $joueur->equipe_id = $request->equipe_id;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos', $imageName);
            $joueur->photo = 'photos/' . $imageName;
        }
      
        $joueur->save();

        return redirect()->route('joueurs.index')->with('success', 'Joueur ajouté avec succès.');
    }

    public function edit($id)
    {
        $joueur = Joueur::find($id);
        $saisons = Saison::all();
        $equipes = Equipe::all();

        return view('joueur.edit', compact('joueur', 'saisons', 'equipes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'date_naissance' => 'required',
            'nationalite' => 'required',
            'poste' => 'required',
            'saison_id' => 'required',
            'equipe_id' => 'required',
             // Validation de l'image
        ]);

        $joueur = Joueur::find($id);
        $joueur->prenom = $request->prenom;
        $joueur->nom = $request->nom;
        $joueur->date_naissance = $request->date_naissance;
        $joueur->nationalite = $request->nationalite;
        $joueur->poste = $request->poste;
        $joueur->saison_id = $request->saison_id;
        $joueur->equipe_id = $request->equipe_id;

        $joueur->save();

        return redirect()->route('joueurs.index')->with('success', 'Joueur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $joueur = Joueur::find($id);
        $joueur->delete();

        return redirect()->route('joueurs.index')->with('success', 'Joueur supprimé avec succès.');
    }
}