@extends('layouts.app_admin')

@section('content')
<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-6">
            <div class="btn-group">
                <a href="{{ route('game.create') }}" id="addRow" class="btn btn-primary">
                    Ajouter un Match <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4" style="background-color: white;">
        <thead>
            <tr>
                <th>Equipe A</th>
                <th>Equipe B</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($games as $game)
            <tr>
                <td>{{ $game->homeTeam->nom }}</td>
                <td>{{ $game->awayTeam->nom }}</td>
                <td>{{ $game->date }}</td>
                <td>
                  
                    <a href="#" onclick="openDetailsModal('{{ $game->id }}')" title="Voir Détails"><i class="fas fa-eye text-info"></i></a>
                    <a href="#" title="Modifier" onclick="openEditModal('{{ $game->id }}')"><i class="fas fa-edit text-warning"></i></a>
                    
                    <a href="#" title="Supprimer" onclick="confirmDelete('{{ $game->id }}')"><i class="fas fa-trash-alt text-danger"></i></a>
                    <form id="delete-form-{{ $game->id }}" action="{{ route('game.destroy', $game->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Aucun match trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary >
          <h5 class="modal-title" id="editMatchModalLabel">Modifier le match</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editMatchModalBody">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" onclick="confirmUpdate()" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade animate__animated animate__fadeIn " id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white >
                <h5 class="modal-title" id="detailsModalLabel">Détails du Match</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailsModalBody">
                <!-- Les détails du joueur seront chargés ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   
   function openDetailsModal(gameId) {
    $.ajax({
        url: `/games/${gameId}`,
        type: 'GET',
        success: function(response) {
            $('#detailsModalBody').html(response);
            $('#detailsModal').modal('show');
        },
        error: function() {
            console.error('Erreur lors de la récupération des détails du joueur.');
        }
    });
}

  function openEditModal(gameId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/games/${gameId}/edit`,
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
    function confirmUpdate() {
    let homeTeam = document.querySelector('select[name="home_team_id"]').value;
    let awayTeam = document.querySelector('select[name="away_team_id"]').value;
    let date = document.querySelector('input[name="date"]').value;
    let heure = document.querySelector('input[name="heure"]').value;
    let lieu = document.querySelector('input[name="lieu"]').value;
    let journee = document.querySelector('input[name="journee"]').value;
    let stade = document.querySelector('select[name="stade_id"]').value;
    let saison = document.querySelector('select[name="saison_id"]').value;
    

    if (homeTeam.trim() === '' || awayTeam.trim() === '' || date.trim() === '' || heure.trim() === '' || lieu.trim() === '' || journee.trim() === '' || stade.trim() === '' || saison.trim() === '') 
    { Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error'); } 
    else { Swal.fire(
        { title: 'Êtes-vous sûr?',
         text: 'Voulez-vous vraiment enregistrer les modifications de ce match?',
          icon: 'question', showCancelButton: true, confirmButtonColor: '#3085d6', 
          cancelButtonColor: '#d33', confirmButtonText: 'Oui, enregistrer', 
          cancelButtonText: 'Annuler' }).then((result) => { if (result.isConfirmed) { document.getElementById('editGameForm').submit();
           Swal.fire('Modifié!', 'Les modifications du match ont été enregistrées avec succès.', 'success'); } }); }}
    function confirmDelete(gameId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment supprimer ce Match?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/games/${gameId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        Swal.fire('Supprimé!', 'Le match a été supprimé avec succès.', 'success').then(() => {
                            window.location.href = data.redirect;
                        });
                    } else {
                        Swal.fire('Désolé','Une erreur s\'est produite.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Désolé', 'Une erreur s\'est produite.', 'error');
                });
            }
        });
    }
    </script>
@endsection