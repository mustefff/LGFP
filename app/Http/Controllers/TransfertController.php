<?php

namespace App\Http\Controllers;

use App\Models\Transfert;
use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransfertController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->statut === 'gequipe') {
            $transferts = Transfert::where('equipe_id', $user->equipe->id)->get();
            dd('Reaching this line');
            return view('transfert.index', compact('transferts'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé.');
        }
    }

    public function edit($id)
    {
        $transfert = Transfert::find($id);
        $equipes = Equipe::all();
        return view('transfert.edit', compact('transfert', 'equipes'));
    }

    public function update(Request $request, $id)
    {
        $transfert = Transfert::find($id);
        $request->validate([
            'num_maillot' => 'required|integer',
            'equipe_id' => 'required|exists:equipes,id',
            'duree_contrat' => 'nullable|string',
            'document_contrat' => 'nullable|file|mimes:pdf|max:2048',
            'examen_medical_reussi' => 'nullable|boolean',
        ]);

        $documentPath = $transfert->document_contrat;
        if ($request->hasFile('document_contrat')) {
            if ($documentPath) {
                Storage::delete($documentPath);
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

        return redirect()->route('transfert.index')->with('success', 'Transfert mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $transfert = Transfert::find($id);
        if ($transfert->document_contrat) {
            Storage::delete($transfert->document_contrat);
        }
        $transfert->delete();
        return redirect()->route('transfert.index')->with('success', 'Transfert supprimé avec succès.');
    }
}
