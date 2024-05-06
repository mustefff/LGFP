@extends('layouts.app_admin')

@section('content')
<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-6">
            <div class="btn-group">
                <!-- Correction de la route pour ajouter une nouvelle équipe -->
                <a href="{{ route('equipe.create') }}" id="addRow" class="btn btn-primary">
                    Ajouter une Nouvelle Équipe <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4" style="background-color: white;">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Ville</th>
                <th>Budget</th> <!-- Correction : Suppression de la colonne 'Équipe' inutile -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipes as $equipe)
            <tr class="odd gradeX">
                <td class="patient-img">
                    @if($equipe->photo)
                    <img src="{{ Storage::url($equipe->photo) }}" alt="Photo de {{ $equipe->nom }}" style="width: 50px; height: auto;">
                    @else
                    <span>Aucune photo disponible</span>
                    @endif
                </td>
                <td>{{ $equipe->nom }}</td>
                <td>{{ $equipe->ville }}</td>
                <td>{{ $equipe->budget }}</td>
                <td>
                    
                    <a href="#" onclick="openDetailsModal('{{ $equipe->id }}')" title="Voir Détails"><i class="fas fa-eye text-info"></i></a>
        
                    <a href="#" title="Modifier" onclick="openEditModal('{{ $equipe->id }}')"><i class="fas fa-edit text-warning"></i></a>
                    <!-- Correction de la méthode de suppression avec SweetAlert -->
                    <a href="#" title="Supprimer" onclick="confirmDelete('{{ $equipe->id }}')"><i class="fas fa-trash-alt text-danger"></i></a>
                    <form id="delete-form-{{ $equipe->id }}" action="{{ route('equipe.destroy', $equipe->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Aucune équipe trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary >
                <h5 class="modal-title" id="editMatchModalLabel">Modifier l'équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="editMatchModalBody">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" onclick="confirmModification()" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade animate__animated animate__fadeIn " id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white >
                <h5 class="modal-title" id="detailsModalLabel">Détails de l'équipe</h5>
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
     function openDetailsModal(equipeId) {
    $.ajax({
        url: `/equipe/${equipeId}`,
        type: 'GET',
        success: function(response) {
            $('#detailsModalBody').html(response);
            $('#detailsModal').modal('show');
        },
        error: function() {
            console.error('Erreur lors de la récupération des détails de l/equipe.');
        }
    });
}


    function openEditModal(equipeId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/equipes/${equipeId}/edit`,
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
     function confirmModification() {
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir modifier cette équipe ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, modifier',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit();
                Swal.fire('Succès!', 'L\'équipe a été modifiée avec succès.', 'success');
            }
        });
    }
    function confirmDelete(equipeId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment supprimer cette équipe?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/equipe/${equipeId}`, {
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
                        Swal.fire('Supprimée!', 'L\'équipe a été supprimée avec succès.', 'success').then(() => {
                            window.location.href = data.redirect;
                        });
                    } else {
                        Swal.fire('Désolé', 'Une erreur s\'est produite.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Désolé', 'Une erreur s\'est produite.', 'error');
                });
            }
        });
    }
    </script>

    <style>

.modal-header, .modal-footer {
  background-color: #f8f9fa; /* Couleur de fond claire */
  border-color: #dee2e6; /* Bordure légère */
}

.modal-title {
  color: #495057; /* Couleur de texte foncée pour un contraste élégant */
}

.modal-content {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Ombre pour un effet de profondeur */
}

.form-control {
  border-radius: 0.25rem; /* Bordures arrondies pour les champs de formulaire */
  border: 1px solid #ced4da; /* Bordure subtile pour les champs de formulaire */
}

.btn-primary {
  background-color: #007bff; /* Couleur primaire pour les boutons d'action */
  border-color: #007bff; /* Bordure des boutons d'action */
}

.btn-secondary {
  background-color: #6c757d; /* Couleur secondaire pour les boutons de fermeture */
  border-color: #6c757d; /* Bordure des boutons de fermeture */
}

    </style>
@endsection