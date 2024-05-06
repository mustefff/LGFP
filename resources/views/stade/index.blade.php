@extends('layouts.app_admin')

@section('content')
<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-6">
            <div class="btn-group">
                <a href="{{ route('stade.create') }}" id="addRow" class="btn btn-primary">
                    Ajouter un Stade <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4" style="background-color: white;">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Emplacement</th>
                <th>Capacité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stades as $stade)
            <tr class="odd gradeX">
                <td>{{ $stade->nom }}</td>
                <td>{{ $stade->emplacement }}</td> 
                <td>{{ $stade->capacite }}</td>
                <td>
                    
                    <a href="#" title="Modifier" onclick="openEditModal('{{ $stade->id }}')"><i class="fas fa-edit text-warning"></i></a>
                    <a href="#" title="Supprimer" onclick="confirmDelete('{{ $stade->id }}')"><i class="fas fa-trash-alt text-danger"></i></a>
                    <form id="delete-form-{{ $stade->id }}" action="{{ route('stade.destroy', $stade->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Aucun stade trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary >
          <h5 class="modal-title" id="editMatchModalLabel">Modifier le stade</h5>
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

<script>
function openEditModal(stadeId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/stades/${stadeId}/edit`,
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
    let nom = document.querySelector('input[name="nom"]').value;
    let emplacement = document.querySelector('input[name="emplacement"]').value;
    let capacite = document.querySelector('input[name="capacite"]').value;

    if (nom.trim() === '' || emplacement.trim() === '' || capacite.trim() === '') {
        Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
    } else {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment enregistrer les modifications?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, enregistrer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editStadeForm').submit();
                Swal.fire('Modifié!', 'Les modifications ont été enregistrées avec succès.', 'success');
            }
        });
    }
}
    function confirmDelete(stadeId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment supprimer ce stade?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/stades/${stadeId}`, {
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
                        Swal.fire('Supprimé!', 'Le stade a été supprimé avec succès.', 'success').then(() => {
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
@endsection