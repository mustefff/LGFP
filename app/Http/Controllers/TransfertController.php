<?php

namespace App\Http\Controllers;

use App\Models\Transfert;
use Illuminate\Http\Request;

class TransfertController extends Controller
{
    public function index()
    {
        $transferts = Transfert::all();
        return view('transfert.index', compact('transferts'));
    }

    public function show($id)
    {
        $transfert = Transfert::find($id);
        return view('transfert.show', compact('transfert'));
    }

    public function create()
    {
        return view('transfert.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'num_maillot' => 'required',
            'periode' => 'required',
            'equipe_id' => 'required',
            'joueur_id' => 'required',
        ]);

        Transfert::create($request->all());

        return redirect()->route('transfert.index')->with('success', 'Transfert créé avec succès.');
    }

    public function edit($id)
    {
        $transfert = Transfert::find($id);
        return view('transfert.edit', compact('transfert'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'num_maillot' => 'required',
            'periode' => 'required',
            'equipe_id' => 'required',
            'joueur_id' => 'required',
        ]);

        $transfert = Transfert::find($id);
        $transfert->update($request->all());

        return redirect()->route('transfert.index')->with('success', 'Transfert mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $transfert = Transfert::find($id);
        $transfert->delete();

        return redirect()->route('transfert.index')->with('success', 'Transfert supprimé avec succès.');
    }
}