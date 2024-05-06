<?php

namespace App\Http\Controllers;

use App\Models\Saison;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SaisonController extends Controller
{
    public function index()
    {
        $saisons = Saison::all();
        return view('saison.index', compact('saisons'));
    }

    public function show($id)
    {
        $saison = Saison::find($id);
        return view('saison.show', compact('saison'));
    }

    public function create()
    {
        return view('saison.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        Saison::create($request->all());

        return redirect()->route('saison.index')->with('success', 'Saison créée avec succès.');
    }

    public function edit($id)
    {
        $saison = Saison::find($id);
        return view('saison.edit', compact('saison'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        $saison = Saison::find($id);
        $saison->update($request->all());

        return redirect()->route('saison.index')->with('success', 'Saison mise à jour avec succès.');
    }

  
  
   
    
    public function destroy(Request $request, $id)
    {
        try {
            $saison = Saison::find($id);
            $saison->delete();
            return response()->json(['success' => true, 'redirect' => route('saison.index')]);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite lors de la suppression de la saison.']);
        }
    }
}