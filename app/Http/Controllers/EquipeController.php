<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipeController extends Controller
{
    public function index()
    {
        $equipes = Equipe::all();
      
        
        return view('equipe.index', compact('equipes'));
    }


    public function show($id)
    {
        $equipe = Equipe::findOrFail($id);
        return view('equipe.show', compact('equipe'));
    }

    public function create()
    {
        return view('equipe.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'ville' => 'required',
        'budget' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validation de l'image
    ]);

    $equipe = new Equipe();
    $equipe->nom = $request->nom;
    $equipe->ville = $request->ville;
    $equipe->budget = $request->budget;

    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/photos', $imageName);
        $equipe->photo = 'photos/' . $imageName;
    }

    $equipe->save();

    return redirect()->route('equipe.index')->with('success', 'Équipe créée avec succès.');
}
    public function edit($id)
    {
        $equipe = Equipe::find($id);
        return view('equipe.edit', compact('equipe'));
    }
    
    public function update(Request $request, $id)
    {
        $equipe = Equipe::find($id);
        $equipe->nom = $request->input('nom');
        $equipe->ville = $request->input('ville');
        $equipe->budget = $request->input('budget');
        $equipe->save();
    
        return redirect()->route('equipe.index')->with('success', 'Équipe mise à jour avec succès');
    }

    public function destroy(Request $request, $id)
    {
        try {
            $equipe = Equipe::find($id);
            $equipe->delete();
            return response()->json(['success' => true, 'redirect' => route('equipe.index')]);
        } catch (QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite lors de la suppression de l\'équipe.']);
        }
    }
}