<!-- resources/views/manager/edit_transfert.blade.php -->

@extends('layouts.app_gequipe')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header text-white text-center">
                    <h2 class="mb-0">Modifier la Proposition de Transfert</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('transferts.update', $transfert->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="equipe_id">Équipe Proposée:</label>
                            <select name="equipe_id" id="equipe_id" class="form-control" required>
                                @foreach($equipes as $equipe)
                                    <option value="{{ $equipe->id }}" {{ $transfert->equipe_id == $equipe->id ? 'selected' : '' }}>{{ $equipe->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="num_maillot">Numéro de Maillot:</label>
                            <input type="number" name="num_maillot" id="num_maillot" class="form-control" value="{{ $transfert->num_maillot }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="duree_contrat">Durée du Contrat:</label>
                            <input type="text" name="duree_contrat" id="duree_contrat" class="form-control" value="{{ $transfert->duree_contrat }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="document_contrat">Document de Contrat:</label>
                            <input type="file" name="document_contrat" id="document_contrat" class="form-control-file" accept="application/pdf">
                            @if($transfert->document_contrat)
                                <small class="form-text text-muted">Document actuel : <a href="{{ Storage::url($transfert->document_contrat) }}" target="_blank" class="text-primary">Voir</a></small>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label for="examen_medical_reussi">Examen Médical Réussi:</label>
                            <select name="examen_medical_reussi" id="examen_medical_reussi" class="form-control">
                                <option value="0" {{ !$transfert->examen_medical_reussi ? 'selected' : '' }}>Non</option>
                                <option value="1" {{ $transfert->examen_medical_reussi ? 'selected' : '' }}>Oui</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
       
        text-align: center;
    }

    .card-header h2 {
        margin: 0;
        font-weight: bold;
    }

    .form-group label {
        font-weight: bold;
        color: #333;
    }

    .form-control, .form-control-file {
        border-radius: 10px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        height: 50px;
    }

    .btn-primary {
        background: linear-gradient(45deg, #066666, #004d4d);
        border: none;
        border-radius: 10px;
        transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
        padding: 15px 30px;
        font-size: 18px;
        width: 100%;
    }

    .btn-primary:hover {
        transform: scale(1.05);
    }

 
</style>

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endpush
@endsection
