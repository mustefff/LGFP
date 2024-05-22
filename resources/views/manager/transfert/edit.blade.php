@extends('layouts.app_gequipe')

@section('content')
<div class="container mt-5">
    <div class="form-container">
        <h4 class="form-title">Éditer le Transfert</h4>
        <form action="{{ route('transfert.update', $transfert->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <label for="joueur_id">Joueur</label>
                <input type="text" class="form-control" id="joueur_id" name="joueur_id" value="{{ $transfert->joueur->prenom }} {{ $transfert->joueur->nom }}" disabled>
            </div>
            <div class="form-group mb-4">
                <label for="num_maillot">Numéro de maillot</label>
                <input type="text" class="form-control" id="num_maillot" name="num_maillot" value="{{ $transfert->num_maillot }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="equipe_id">Équipe de Destination</label>
                <select class="form-control" id="equipe_id" name="equipe_id" required>
                    @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}" {{ $transfert->equipe_id == $equipe->id ? 'selected' : '' }}>{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="duree_contrat">Durée du contrat</label>
                <input type="text" class="form-control" id="duree_contrat" name="duree_contrat" value="{{ $transfert->duree_contrat }}">
            </div>
            <div class="form-group mb-4">
                <label for="document_contrat">Document du contrat (PDF)</label>
                <input type="file" class="form-control" id="document_contrat" name="document_contrat" accept="application/pdf">
            </div>
            <div class="form-group mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="examen_medical_reussi" name="examen_medical_reussi" {{ $transfert->examen_medical_reussi ? 'checked' : '' }}>
                    <label class="form-check-label" for="examen_medical_reussi">
                        Examen médical réussi
                    </label>
                </div>
            </div>
            <button type="submit"  class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection

