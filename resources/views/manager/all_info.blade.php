@extends('layouts.app_gequipe')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Informations Complètes des Joueurs de l'Équipe</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Poste</th>
                    <th>Numéro de maillot</th>
                    <th>Voir plus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($joueurs as $joueur)
                <tr>
                    <td>
                        @if($joueur->photo)
                        <img src="{{ Storage::url($joueur->photo) }}" alt="Photo de {{ $joueur->nom }}" style="width: 50px; height: auto; border-radius: 50%;">
                        @else
                        <span>Aucune photo disponible</span>
                        @endif
                    </td>
                    <td>{{ $joueur->prenom }} {{ $joueur->nom }}</td>
                    <td>{{ $joueur->poste }}</td>
                    <td>{{ $joueur->num_maillot }}</td>
                    <td>
                        <button type="button" class="icon-button" data-toggle="modal" data-target="#joueurModal{{ $joueur->id }}">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>
                  
                    
                </tr>
                
                <!-- Modal -->
                <div class="modal fade" id="joueurModal{{ $joueur->id }}" tabindex="-1" role="dialog" aria-labelledby="joueurModalLabel{{ $joueur->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white>
                                <h5 class="modal-title" id="joueurModalLabel{{ $joueur->id }}">{{ $joueur->prenom }} {{ $joueur->nom }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        @if($joueur->photo)
                                        <img src="{{ Storage::url($joueur->photo) }}" alt="Photo de {{ $joueur->nom }}" class="img-fluid rounded mb-3">
                                        @else
                                        <span>Aucune photo disponible</span>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><i class="fas fa-calendar-alt"></i> <strong>Date de naissance:</strong> {{ $joueur->date_naissance }}</p>
                                                <p><i class="fas fa-arrows-alt-v"></i> <strong>Taille:</strong> {{ $joueur->taille }} cm</p>
                                                <p><i class="fas fa-weight"></i> <strong>Poids:</strong> {{ $joueur->poids }} kg</p>
                                                <p><i class="fas fa-flag"></i> <strong>Nationalité:</strong> {{ $joueur->nationalite }}</p>
                                                <p><i class="fas fa-calendar-check"></i> <strong>Début de carrière:</strong> {{ $joueur->debut_carriere }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><i class="fas fa-futbol"></i> <strong>Dribbles:</strong> {{ $joueur->dribbles }}</p>
                                                <p><i class="fas fa-passport"></i> <strong>Passes:</strong> {{ $joueur->passes }}</p>
                                                <p><i class="fas fa-hand-paper"></i> <strong>Duel:</strong> {{ $joueur->duel }}</p>
                                                <p><i class="fas fa-shield-alt"></i> <strong>Tirs bloqués:</strong> {{ $joueur->tirs_bloques }}</p>
                                                <p><i class="fas fa-exclamation-triangle"></i> <strong>Interception:</strong> {{ $joueur->interception }}</p>
                                                <p><i class="fas fa-people-arrows"></i> <strong>Abord:</strong> {{ $joueur->abord }}</p>
                                                <p><i class="fas fa-recycle"></i> <strong>Recouvrement:</strong> {{ $joueur->recouvrement }}</p>
                                                <p><i class="fas fa-shield-virus"></i> <strong>Dernier homme:</strong> {{ $joueur->dernier_homme }}</p>
                                                <p><i class="fas fa-trash-alt"></i> <strong>Dégagement:</strong> {{ $joueur->degagement }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap CSS -->


<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom CSS -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table thead th {
        background-color: #006666;
        color: #fff;
    }
    .icon-button {
        background: none;
        border: none;
        color: #006666;
        cursor: pointer;
        font-size: 1.2em;
        transition: color 0.3s;
    }
    .icon-button:hover {
        color: #4e6969;
    }
    .modal-lg {
        max-width: 80%;
    }
    .modal-body p {
        margin: 0.5em 0;
    }
</style>

@endsection
