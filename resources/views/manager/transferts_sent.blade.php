<!-- resources/views/manager/transferts_sent.blade.php -->

@extends('layouts.app_gequipe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header  text-white text-center">
                    <h2 class="mb-0">Propositions de Transfert Envoyées</h2>
                </div>
                <div class="card-body">
                    @if($transferts->isEmpty())
                        <p class="text-center">Vous n'avez proposé aucun transfert.</p>
                    @else
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Joueur</th>
                                    <th>Équipe Proposée</th>
                                    <th>Numéro de Maillot</th>
                                    <th>Durée du Contrat</th>
                                    <th>Document</th>
                                    <th>Examen Médical</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transferts as $transfert)
                                    <tr>
                                        <td>{{ $transfert->joueur->nom }}</td>
                                        <td>{{ $transfert->equipe->nom }}</td>
                                        <td>{{ $transfert->num_maillot }}</td>
                                        <td>{{ $transfert->duree_contrat }}</td>
                                        <td>
                                            @if($transfert->document_contrat)
                                                <a href="{{ Storage::url($transfert->document_contrat) }}" target="_blank" class="text-primary">
                                                    <i class="fas fa-file-pdf"></i> Voir
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $transfert->examen_medical_reussi ? 'Oui' : 'Non' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('transferts.edit', $transfert->id) }}" class="btn btn-link text-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transferts.destroy', $transfert->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette proposition de transfert ?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table thead th {
        border-bottom: 2px solid #dee2e6;
    }

    .btn-link {
        font-size: 1.2em;
        padding: 0;
    }

    .btn-link i {
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
@endpush
