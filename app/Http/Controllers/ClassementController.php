<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use Illuminate\Http\Request;

class ClassementController extends Controller
{
    public function index()
    {
        $classements = Classement::all();
        return view('classement.index', compact('classements'));
    }

    public function show($id)
    {
        $classement = Classement::find($id);
        return view('classement.show', compact('classement'));
    }

    public function create()
    {
        return view('classement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_points' => 'required',
            'nombre_match' => 'required',
            'saison_id' => 'required',
            'equipe_id' => 'required',
        ]);

        Classement::create($request->all());

        return redirect()->route('classement.index')->with('success', 'Classement créé avec succès.');
    }

    public function edit($id)
    {
        $classement = Classement::find($id);
        return view('classement.edit', compact('classement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_points' => 'required',
            'nombre_match' => 'required',
            'saison_id' => 'required',
            'equipe_id' => 'required',
        ]);

        $classement = Classement::find($id);
        $classement->update($request->all());

        return redirect()->route('classement.index')->with('success', 'Classement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $classement = Classement::find($id);
        $classement->delete();

        return redirect()->route('classement.index')->with('success', 'Classement supprimé avec succès.');
    }
}