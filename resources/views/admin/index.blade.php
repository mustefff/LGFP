@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Liste des Gestionnaires d'Équipe
                        <a href="{{ route('admin.create') }}" class="btn btn-primary float-right">Ajouter</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Équipe</th>
                                    <th>Date de Naissance</th>
                                    <th>Nationalité</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gestionnairesEquipe as $gestionnaire)
                                    <tr>
                                        <td>
                                            @if($gestionnaire->photo)
                                                <img src="{{ Storage::url($gestionnaire->photo) }}" alt="Photo de {{ $gestionnaire->nom }}" style="width: 50px; height: auto; border-radius: 50%;">
                                            @else
                                                <span>Aucune photo disponible</span>
                                            @endif
                                        </td>
                                        <td>{{ $gestionnaire->prenom }}</td>
                                        <td>{{ $gestionnaire->name }}</td>
                                        <td>{{ $gestionnaire->email }}</td>
                                        <td>{{ $gestionnaire->equipe->nom }}</td>
                                        <td>{{ $gestionnaire->date_naissance }}</td>
                                        <td>{{ $gestionnaire->nationalite }}</td>
                                        <td>
                                            
                                            <a href="#" onclick="openDetailsModal('{{ $gestionnaire->id }}')" title="Voir Détails"><i class="fas fa-eye text-info"></i></a>
                                            <a href="#" title="Modifier" onclick="openEditModal('{{ $gestionnaire->id }}')"><i class="fas fa-edit text-primary"></i></a>
                                            <form id="deleteForm{{ $gestionnaire->id }}" action="{{ route('admin.destroy', $gestionnaire->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $gestionnaire->id }})" class="btn btn-link" style="padding: 0;"><i class="fas fa-trash-alt text-danger"></i></button>
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
              <h5 class="modal-title" id="editMatchModalLabel">Modifier le gestionnaire d'équipe</h5>
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
                    <h5 class="modal-title" id="detailsModalLabel">Détails du gérant d'équipe</h5>
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

    <script>

function openDetailsModal(adminId) {
    $.ajax({
        url: `/admin/${adminId}`,
        type: 'GET',
        success: function(response) {
            $('#detailsModalBody').html(response);
            $('#detailsModal').modal('show');
        },
        error: function() {
            console.error('Erreur lors de la récupération des détails du gérant d equipe.');
        }
    });
}

  function openEditModal(adminId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/admin/${adminId}/edit`,
        type: 'GET',
        success: function(response) {
            // Injecter le HTML dans le corps du modal
            $('#editMatchModal .modal-body').html(response);

            // Afficher le modal
            $('#editMatchModal').modal('show');
        },
        
        error: function() {
            console.error('Erreur lors de la récupération des détails du GE.');
        }
    });
}
          function confirmUpdate() {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir mettre à jour ce gestionnaire d\'équipe ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, mettre à jour',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editForm').submit();
                    Swal.fire('Le gestionnaire d\'équipe a été mis à jour avec succès!', '', 'success');
                }
            });
        }
        function confirmDelete(id) {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer ce gestionnaire d\'équipe ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                    Swal.fire('Le gestionnaire d\'équipe a été supprimé avec succès!', '', 'success');
                }
            });
        }
    </script>

@endsection