<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Transfert;
use Illuminate\Http\Request;

class JoueurManagerController extends Controller
{
    // Méthode index pour afficher la liste des joueurs de l'équipe du gestionnaire d'équipe
    public function index()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté (le gestionnaire d'équipe)
        
        // Vérifier si l'utilisateur est un gestionnaire d'équipe
        if ($user->statut === 'gequipe') {
            $equipe = $user->equipe; 
            $joueurs = $equipe->joueurs; 

            return view('manager.joueur', compact('equipe', 'joueurs'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour afficher les détails d'un joueur spécifique
    public function showDetails(Joueur $joueur)
    {
        return view('manager.details', compact('joueur'));
    }

    // Méthode pour mettre à jour les détails d'un joueur
    public function update(Request $request, Joueur $joueur)
    {
        $joueur->update($request->all());
        return redirect()->route('mjoueurs.index')->with('success', 'Détails mis à jour avec succès.');
    }

    // Méthode pour éditer les détails d'un joueur
    public function edit(Joueur $joueur)
    {
        return view('manager.edit', compact('joueur'));
    }
    
    // Méthode pour récupérer toutes les informations d'un joueur
    public function getAllInfo()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté (le gestionnaire d'équipe)

        // Vérifier si l'utilisateur est un gestionnaire d'équipe
        if ($user->statut === 'gequipe') {
            $equipe = $user->equipe;
            $joueurs = $equipe->joueurs; 

            return view('manager.all_info', compact('equipe', 'joueurs'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour proposer un transfert
    // Méthode pour proposer un transfert
    public function proposeTransfert(Request $request)
{
    $user = Auth::user();
    if ($user->statut === 'gequipe') {
        $request->validate([
            'equipe_id' => 'required|exists:equipes,id',
            'joueur_id' => 'required|exists:joueurs,id',
            'num_maillot' => 'required|integer',
            'duree_contrat' => 'nullable|string',
            'document_contrat' => 'nullable|file|mimes:pdf|max:2048',
            'examen_medical_reussi' => 'nullable|boolean',
        ]);

        $documentPath = null;
        if ($request->hasFile('document_contrat')) {
            $documentPath = $request->file('document_contrat')->store('documents_contrats', 'public');
        }

        Transfert::create([
            'joueur_id' => $request->input('joueur_id'),
            'equipe_id' => $request->input('equipe_id'),
            'num_maillot' => $request->input('num_maillot'),
            'duree_contrat' => $request->input('duree_contrat'),
            'document_contrat' => $documentPath,
            'examen_medical_reussi' => $request->input('examen_medical_reussi', false),
        ]);

        return redirect()->route('mjoueurs.sentTransferts')->with('success', 'Proposition de transfert envoyée avec succès.');
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}



public function showTransfertForm()
{
    $user = Auth::user();
    if ($user->statut === 'gequipe') {
        $equipe = $user->equipe;
        $joueurs = $equipe->joueurs;
        $equipes = Equipe::all(); // S'il est nécessaire d'afficher toutes les équipes

        return view('manager.transfert_form', compact('equipe', 'joueurs', 'equipes'));
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}


// app/Http/Controllers/JoueurManagerController.php

public function editTransfert(Transfert $transfert)
{
    $user = Auth::user();

    if ($user->statut === 'gequipe' && $transfert->joueur->equipe_id === $user->equipe->id) {
        $equipes = Equipe::all();
        return view('manager.edit_transfert', compact('transfert', 'equipes'));
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}

public function updateTransfert(Request $request, Transfert $transfert)
{
    $user = Auth::user();

    if ($user->statut === 'gequipe' && $transfert->joueur->equipe_id === $user->equipe->id) {
        $request->validate([
            'equipe_id' => 'required|exists:equipes,id',
            'num_maillot' => 'required|integer',
            'duree_contrat' => 'nullable|string',
            'document_contrat' => 'nullable|file|mimes:pdf|max:2048',
            'examen_medical_reussi' => 'nullable|boolean',
        ]);

        $documentPath = $transfert->document_contrat;
        if ($request->hasFile('document_contrat')) {
            // Supprimez l'ancien document si un nouveau est téléchargé
            if ($documentPath) {
                Storage::disk('public')->delete($documentPath);
            }
            $documentPath = $request->file('document_contrat')->store('documents_contrats', 'public');
        }

        $transfert->update([
            'equipe_id' => $request->input('equipe_id'),
            'num_maillot' => $request->input('num_maillot'),
            'duree_contrat' => $request->input('duree_contrat'),
            'document_contrat' => $documentPath,
            'examen_medical_reussi' => $request->input('examen_medical_reussi', false),
        ]);

        return redirect()->route('mjoueurs.sentTransferts')->with('success', 'Proposition de transfert mise à jour avec succès.');
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}

public function destroy(Transfert $transfert)
{
    $user = Auth::user(); // Récupérer l'utilisateur connecté (le gestionnaire d'équipe)

    // Vérifier si l'utilisateur est un gestionnaire d'équipe et s'il a le droit de supprimer ce transfert
    if ($user->statut === 'gequipe' && $transfert->joueur->equipe_id === $user->equipe->id) {
        $transfert->delete();

        return redirect()->route('mjoueurs.sentTransferts')->with('success', 'Proposition de transfert supprimée avec succès.');
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}

public function receivedTransferts()
    {
        $user = Auth::user();
        if ($user->statut === 'gequipe') {
            $transferts = Transfert::where('equipe_id', $user->equipe->id)
                ->where('status', 'pending')
                ->get();

            return view('manager.transferts_received', compact('transferts'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour accepter une proposition de transfert par l'équipe acheteuse
    public function approveByTeam(Transfert $transfert)
    {
        $user = Auth::user();
        if ($user->statut === 'gequipe' && $transfert->equipe_id === $user->equipe->id) {
            $transfert->status = 'accepted_by_team';
            $transfert->save();

            return redirect()->route('mjoueurs.receivedTransferts')->with('success', 'Transfert accepté. En attente de l\'approbation de l\'admin.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour refuser une proposition de transfert par l'équipe acheteuse
    public function refuseTransfert(Transfert $transfert)
    {
        $user = Auth::user();
        if ($user->statut === 'gequipe' && $transfert->equipe_id === $user->equipe->id) {
            $transfert->status = 'rejected';
            $transfert->save();

            return redirect()->route('mjoueurs.receivedTransferts')->with('success', 'Transfert refusé.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour afficher les propositions de transfert reçues
   /* public function receivedTransferts()
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté (le gestionnaire d'équipe)
        
        // Vérifier si l'utilisateur est un gestionnaire d'équipe
        if ($user->statut === 'gequipe') {
            $transferts = Transfert::where('equipe_id', $user->equipe->id)->get();

            return view('manager.transferts_received', compact('transferts'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour accepter une proposition de transfert
    public function acceptTransfert(Transfert $transfert)
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté (le gestionnaire d'équipe)
        
        // Vérifier si l'utilisateur est un gestionnaire d'équipe
        if ($user->statut === 'gequipe') {
            // Ajouter le joueur à l'équipe
            $joueur = Joueur::find($transfert->joueur_id);
            $joueur->equipe_id = $user->equipe->id;
            $joueur->save();

            // Supprimer la proposition de transfert
            $transfert->delete();

            return redirect()->route('mjoueurs.index')->with('success', 'Transfert accepté avec succès.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    // Méthode pour refuser une proposition de transfert
    public function refuseTransfert(Transfert $transfert)
    {
        $user = Auth::user(); 
        
        if ($user->statut === 'gequipe') {
            // Supprimer la proposition de transfert
            $transfert->delete();

            return redirect()->route('mjoueurs.index')->with('success', 'Transfert refusé avec succès.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }*/

   // app/Http/Controllers/JoueurManagerController.php

public function sentTransferts()
{
    $user = Auth::user();
    
    if ($user->statut === 'gequipe') {
        // Récupérer les transferts proposés par le gestionnaire connecté
        $transferts = Transfert::whereHas('joueur', function ($query) use ($user) {
            $query->where('equipe_id', $user->equipe->id);
        })->get();

        return view('manager.transferts_sent', compact('transferts'));
    } else {
        return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
    }
}


}
