@extends('layouts.app_gequipe')

@section('content')
<div class="container mt-5">
    <h2>Liste des Transferts</h2>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Joueur</th>
                <th scope="col">Équipe de Destination</th>
                <th scope="col">Numéro de maillot</th>
                <th scope="col">Durée du contrat</th>
                <th scope="col">Examen Médical</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transferts as $transfert)
            <tr>
                <th scope="row">{{ $transfert->id }}</th>
                <td>{{ $transfert->joueur->prenom }} {{ $transfert->joueur->nom }}</td>
                <td>{{ $transfert->equipe->nom }}</td>
                <td>{{ $transfert->num_maillot }}</td>
                <td>{{ $transfert->duree_contrat ?: 'Non spécifiée' }}</td>
                <td>{{ $transfert->examen_medical_reussi ? 'Réussi' : 'En attente' }}</td>
                <td>
                    <a href="{{ route('transfert.edit', $transfert->id) }}" class="btn btn-sm btn-primary">Éditer</a>
                    <form action="{{ route('transfert.destroy', $transfert->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce transfert ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
