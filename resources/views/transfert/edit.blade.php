@extends('layouts.app_gequipe')

@section('content')
<div class="container mt-5">
    <div class="form-container">
        <h4 class="form-title">Modifier le transfert</h4>
        <form action="{{ route('transfert.update', $transfert->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <label for="num_maillot">Numéro de maillot</label>
                <input type="text" class="form-control" id="num_maillot" name="num_maillot" value="{{ $transfert->num_maillot }}" required>
            </div>
            <div class="form-group mb-4">
                <label for="duree_contrat">Durée du contrat</label>
                <input type="text" class="form-control" id="duree_contrat" name="duree_contrat" value="{{ $transfert->duree_contrat }}">
            </div>
            <div class="form-group mb-4">
                <label for="equipe_id">Équipe de Destination</label>
                <select class="form-control" id="equipe_id" name="equipe_id" required>
                    @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}" @if($transfert->equipe_id == $equipe->id) selected @endif>{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="document_contrat">Document du contrat (PDF)</label>
                <input type="file" class="form-control" id="document_contrat" name="document_contrat" accept="application/pdf">
                @if($transfert->document_contrat)
                <small class="form-text text-muted">Document actuel: <a href="{{ Storage::url($transfert->document_contrat) }}" target="_blank">Voir le document</a></small>
                @endif
            </div>
            <div class="form-group mb-4">
                <label for="examen_medical_reussi">Examen médical</label>
                <select class="form-control" id="examen_medical_reussi" name="examen_medical_reussi" required>
                    <option value="1" @if($transfert->examen_medical_reussi) selected @endif>Réussi</option>
                    <option value="0" @if(!$transfert->examen_medical_reussi) selected @endif>Échoué</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>

<style>
/* custom.css */

.form-container {
    background: #fff;
    padding: 50px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    width: 100%;
    max-width: 1400px;
}

.form-container:hover {
    transform: scale(1.03);
}

.form-group label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border-radius: 10px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #f9f9f9;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #007bff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-text {
    font-size: 0.9rem;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}
</style>

@endsection


