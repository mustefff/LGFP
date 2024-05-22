@extends('layouts.app_gequipe')

@section('content')
<div class="container mt-5">
    <h4 class="text-center mb-4">Liste des Transferts</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Joueur</th>
                    <th>Numéro de maillot</th>
                    <th>Durée du contrat</th>
                    <th>Document du contrat</th>
                    <th>Examen médical</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transferts as $transfert)
                <tr>
                    <td>{{ $transfert->joueur->prenom }} {{ $transfert->joueur->nom }}</td>
                    <td>{{ $transfert->num_maillot }}</td>
                    <td>{{ $transfert->duree_contrat }}</td>
                    <td>
                        @if($transfert->document_contrat)
                        <a href="{{ Storage::url($transfert->document_contrat) }}" target="_blank">Voir le document</a>
                        @else
                        Pas de document
                        @endif
                    </td>
                    <td>{{ $transfert->examen_medical_reussi ? 'Réussi' : 'Échoué' }}</td>
                    <td>
                        <a href="{{ route('transfert.edit', $transfert->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('transfert.destroy', $transfert->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
