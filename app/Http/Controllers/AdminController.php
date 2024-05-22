<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipe;
use App\Models\Transfert; // Assurez-vous que le modèle Transfert est importé
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $gestionnairesEquipe = User::where('statut', 'gequipe')->get();
        return view('admin.index', ['gestionnairesEquipe' => $gestionnairesEquipe]);
    }

    public function showCreateForm()
    {
        $equipes = Equipe::all();
        $existingEmails = DB::table('users')->pluck('email')->toArray();
        return view('admin.createGequipe', ['equipes' => $equipes, 'existingEmails' => $existingEmails]);
    }

    public function create(Request $request)
    {
        $user = new User();
        $user->prenom = $request->prenom;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->date_naissance = $request->date_naissance;
        $user->statut = 'gequipe';
        $user->nationalite = $request->nationalite;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/photos', $imageName);
            $user->photo = 'photos/' . $imageName;
        }

        $user->save();

        $equipe = Equipe::find($request->equipe_id);
        if ($equipe) {
            $user->equipe()->associate($equipe);
            $user->save();
        }

        return redirect()->route('admin.index')->with('success', 'Gestionnaire d\'équipe créé avec succès.');
    }

    public function show($id)
    {
        $gestionnaire = User::findOrFail($id);
        return view('admin.show', ['gestionnaire' => $gestionnaire]);
    }

    public function edit($id)
    {
        $gestionnaire = User::findOrFail($id);
        $equipes = Equipe::all();
        return view('admin.edit', ['gestionnaire' => $gestionnaire, 'equipes' => $equipes]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'prenom' => $request->prenom,
            'name' => $request->name,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'nationalite' => $request->nationalite,
        ]);

        $equipe = Equipe::find($request->equipe_id);
        if ($equipe) {
            $user->equipe()->associate($equipe);
            $user->save();
        }

        return redirect()->route('admin.index')->with('success', 'Gestionnaire d\'équipe mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Gestionnaire d\'équipe supprimé avec succès.');
    }

    public function showTransferts()
    {
        $transferts = Transfert::where('status', 'accepted_by_team')->get();
        return view('admin.transferts', compact('transferts'));
    }

    public function approveTransfert($id)
    {
        $transfert = Transfert::find($id);
        if ($transfert && $transfert->status === 'accepted_by_team') {
            $transfert->status = 'approved_by_admin';
            $transfert->save();

            return redirect()->route('admin.transferts')->with('success', 'Transfert approuvé.');
        } else {
            return redirect()->route('admin.transferts')->with('error', 'Transfert non trouvé ou déjà approuvé/refusé.');
        }
    }

    public function rejectTransfert($id)
    {
        $transfert = Transfert::find($id);
        if ($transfert && $transfert->status === 'accepted_by_team') {
            $transfert->status = 'rejected';
            $transfert->save();

            return redirect()->route('admin.transferts')->with('success', 'Transfert refusé.');
        } else {
            return redirect()->route('admin.transferts')->with('error', 'Transfert non trouvé ou déjà approuvé/refusé.');
        }
    }
}
