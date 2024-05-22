@extends('layouts.app_gequipe')

@section('content')
<div class="container mt-5">
    <h4 class="text-center mb-4">Propositions de transfert reçues</h4>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Joueur</th>
                    <th>Numéro de maillot</th>
                    <th>Durée du contrat</th>
                    <th>Examen médical</th>
                    <th>Document du contrat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transferts as $transfert)
                <tr class="table-row">
                    <td class="align-middle">{{ $transfert->joueur->prenom }} {{ $transfert->joueur->nom }}</td>
                    <td class="align-middle">{{ $transfert->num_maillot }}</td>
                    <td class="align-middle">{{ $transfert->duree_contrat }}</td>
                    <td class="align-middle">{{ $transfert->examen_medical_reussi ? 'Réussi' : 'Échoué' }}</td>
                    <td class="align-middle">
                        @if ($transfert->document_contrat)
                            <a href="#" data-toggle="modal" data-target="#documentModal{{ $transfert->id }}">Voir le document</a>
                            <!-- Modal -->

                           
                        @else
                            Aucun document
                        @endif
                    </td>
                    <div class="modal fade" id="documentModal{{ $transfert->id }}" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel{{ $transfert->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="documentModalLabel{{ $transfert->id }}">Document du contrat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <iframe src="{{ asset('storage/' . $transfert->document_contrat) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <form action="{{ route('mjoueurs.acceptTransfert', $transfert) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Accepter">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                            <form action="{{ route('mjoueurs.refuseTransfert', $transfert) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Refuser">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
              
            </tbody>
        </table>
    </div>
</div>

<!-- Adding custom CSS -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fafafa;
    }
    .table thead th {
        background-color: #006666;
        color: #fff;
        text-transform: uppercase;
    }
    .table-row {
        transition: all 0.3s ease;
    }
    .table-row:hover {
        transform: scale(1.02);
    }
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .btn-group .btn i {
        pointer-events: none;
    }
    .container h4 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #006666;
    }
</style>

<!-- Adding custom JS for tooltips -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
