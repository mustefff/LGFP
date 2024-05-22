@extends('layouts.app_gequipe')
<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white>
                <h5 class="modal-title" id="editMatchModalLabel">Ajouter details suplémentaires du joueur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editMatchModalBody">
                <!-- Contenu chargé via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" onclick="validateForm()" class="btn btn-primary">Actualiser</button>
            </div>
        </div>
    </div>
</div>
@section('content')



<h4 class="mb-4">Ajouter détails supplémentaires des joueurs</h4>

<div class="row">
    @foreach($joueurs as $joueur)
        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">
                    <div class="social-img-wrap">
                        <div class="social-img">
                            @if($joueur->photo)
                                <img src="{{ Storage::url($joueur->photo) }}" alt="Photo de {{ $joueur->nom }}" style="width: 50px; height: auto; border-radius: 50%;">
                            @else
                                <span>Aucune photo disponible</span>
                            @endif
                        </div>
                        <div class="edit-icon">
                            <svg>
                                <use href="../assets/svg/icon-sprite.svg#profile-check"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="social-details">
                        <h5 class="mb-1"><a href="#" onclick="openEditModal('{{ $joueur->id }}')">{{ $joueur->prenom }} {{ $joueur->nom }}</a></h5><span class="f-light">{{ $joueur->poste }}</span>
                        
                        <ul class="social-follow">
                            <li>
                                <h5 class="mb-0">{{ $joueur->num_maillot }}</h5><span class="f-light">Numero de maillot</span>
                            </li>
                            <li>
                                <h5 class="mb-0">{{ $joueur->taille }}</h5><span class="f-light">Taille</span>
                            </li>
                            <li>
                                <h5 class="mb-0">{{ $joueur->poids }}</h5><span class="f-light">Poids</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>



<script>
    function openEditModal(joueurId) {
        $.ajax({
            url: `/joueur/${joueurId}/edit`,
            type: 'GET',
            success: function(response) {
                $('#editMatchModalBody').html(response);
                $('#editMatchModal').modal('show');
            },
            error: function() {
                console.error('Erreur lors de la récupération des détails du joueur.');
            }
        });
    }

    function validateForm() {
        document.getElementById('editForm').submit();
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Détails mis à jour avec succès.'
        });
    }
</script>

@endsection
