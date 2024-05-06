<?php

namespace App\Http\Controllers;

use App\Models\Stade;
use Illuminate\Http\Request;

class StadeController extends Controller
{
    public function index()
    {
        $stades = Stade::all();
        return view('stade.index', compact('stades'));
    }

    public function show($id)
    {
        $stade = Stade::find($id);
        return view('stade.show', compact('stade'));
    }

    public function create()
    {
        return view('stade.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'emplacement' => 'required',
            'capacite' => 'required',
        ]);

        Stade::create($request->all());

        return redirect()->route('stade.index')->with('success', 'Stade créé avec succès.');
    }

    public function edit($id)
    {
        $stade = Stade::find($id);
        return view('stade.edit', compact('stade'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'emplacement' => 'required',
            'capacite' => 'required',
        ]);

        $stade = Stade::find($id);
        $stade->update($request->all());

        return redirect()->route('stade.index')->with('success', 'Stade mis à jour avec succès.');
    }

    public function destroy(Request $request, $id)
{
    try {
        $stade = Stade::find($id);
        $stade->delete();
        return response()->json(['success' => true, 'redirect' => route('stade.index')]);
    } catch (QueryException $e) {
        return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite lors de la suppression du stade.']);
    }
}
}