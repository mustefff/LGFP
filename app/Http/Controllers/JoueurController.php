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

    public function pendingTransferts()
{
    $user = Auth::user();
    if ($user->statut === 'gequipe') {
        // Filtrer les transferts initiés par l'équipe de l'utilisateur et en attente (examen médical non réussi)
        $transferts = Transfert::whereHas('joueur', function ($query) use ($user) {
            $query->where('equipe_id', $user->equipe->id);
        })->where('examen_medical_reussi', false)
          ->get();

        return view('manager.transferts_pending', compact('transferts'));
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}


    public function editTransfert($id)
{
    $user = Auth::user();
    $transfert = Transfert::find($id);

    if ($user->statut === 'gequipe' && $transfert->joueur->equipe_id == $user->equipe->id) {
        $equipes = Equipe::all();
        return view('manager.transfert_edit', compact('transfert', 'equipes'));
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}

public function updateTransfert(Request $request, $id)
{
    $request->validate([
        'num_maillot' => 'required|integer',
        'equipe_id' => 'required|exists:equipes,id',
        'duree_contrat' => 'nullable|string',
        'document_contrat' => 'nullable|file|mimes:pdf|max:2048',
        'examen_medical_reussi' => 'nullable|boolean',
    ]);

    $transfert = Transfert::find($id);
    $user = Auth::user();

    if ($transfert->joueur->equipe_id != $user->equipe->id) {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }

    if ($request->hasFile('document_contrat')) {
        if ($transfert->document_contrat) {
            Storage::delete($transfert->document_contrat);
        }
        $documentPath = $request->file('document_contrat')->store('documents_contrats', 'public');
        $transfert->document_contrat = $documentPath;
    }

    $transfert->num_maillot = $request->input('num_maillot');
    $transfert->equipe_id = $request->input('equipe_id');
    $transfert->duree_contrat = $request->input('duree_contrat');
    $transfert->examen_medical_reussi = $request->input('examen_medical_reussi', false);
    $transfert->save();

    return redirect()->route('mjoueurs.pendingTransferts')->with('success', 'Transfert mis à jour avec succès.');
}


    public function destroy($id)
    {
        $joueur = Joueur::find($id);
        $joueur->delete();

        return redirect()->route('joueurs.index')->with('success', 'Joueur supprimé avec succès.');
    }
}