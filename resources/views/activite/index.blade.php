@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des activités</div>

                <div class="card-body">
                    <a href="{{ route('activite.create') }}" class="btn btn-primary mb-3">Créer une nouvelle activité</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Temps de jeu</th>
                                <th>Type d'activité</th>
                                <th>Match</th>
                                <th>Joueur</th>
                                <th>Saison</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activites as $activite)
                                <tr>
                                    <td>{{ $activite->temps_jeu }}</td>
                                    <td>{{ $activite->type_activite }}</td>
                                    <td>
                                        @if($activite->game && $activite->game->homeTeam)
                                            {{ $activite->game->homeTeam->nom }} vs {{ $activite->game->awayTeam->nom }}
                                        @else
                                            Match non défini
                                        @endif
                                    </td>
                                    <td>
                                        @if($activite->joueur)
                                            {{ $activite->joueur->nom }}
                                        @else
                                            Joueur non défini
                                        @endif
                                    </td>

                                    <td>
                                        @if($activite->saison)
                                            {{ $activite->saison->libelle }}
                                        @else
                                            Saison non défini
                                        @endif
                                    </td>
                                    <td>
                                       
                                        <a href="#" title="Modifier" onclick="openEditModal('{{ $activite->id }}')"><i class="fas fa-edit text-warning"></i></a>
                                        <form id="deleteForm{{ $activite->id }}" action="{{ route('activite.destroy', $activite->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $activite->id }})" class="btn-icon delete-icon" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary >
          <h5 class="modal-title" id="editMatchModalLabel">Modifier l'activité</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editMatchModalBody">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" onclick="validateForm()" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>

<script>
     function openEditModal(activiteId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/activites/${activiteId}/edit`,
        type: 'GET',
        success: function(response) {
            // Injecter le HTML dans le corps du modal
            $('#editMatchModal .modal-body').html(response);

            // Afficher le modal
            $('#editMatchModal').modal('show');
        },
        
        error: function() {
            console.error('Erreur lors de la récupération des détails du match.');
        }
    });
}
     function validateForm() {
        let tempsJeu = document.getElementById('temps_jeu').value;
        let typeActivite = document.getElementById('type_activite').value;
        let gameId = document.getElementById('game_id').value;
        let saisonId = document.getElementById('saison_id').value;
        if (tempsJeu === '' || typeActivite === '' || gameId === '' || joueurId === '' || saisonId === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez remplir tous les champs avant de mettre à jour l\'activité.'
            });
        } else {
            document.getElementById('activiteForm').submit();
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'L\'activité a été mise à jour avec succès.'
            });
        }
    }
    function confirmDelete(id) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous ne pourrez pas revenir en arrière!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'L\'activité a été supprimé avec succès.'
                });
            }
        });
    }
</script>

@endsection