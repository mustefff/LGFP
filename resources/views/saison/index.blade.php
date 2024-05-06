@extends('layouts.app_admin')

@section('content')
<div class="container-fluid"> <!-- Changement ici pour un conteneur fluide -->
    <div class="row">
        <div class="col-12"> <!-- Changement pour occuper toute la largeur -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Liste des Saisons</h2>
                        <a href="{{ route('saisons.create') }}" class="btn btn-success">Créer une Saison</a>
                    </div>
                </div>
                <div class="card-body">
                    @if($saisons->isEmpty())
                        <p>Aucune saison n'a été trouvée.</p>
                    @else
                        <table class="table"> <!-- Utilisation d'une table pour un design plus simple -->
                            <thead>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Période</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($saisons as $saison)
                                    <tr>
                                        <td>{{ $saison->libelle }}</td>
                                        <td>Du {{ $saison->date_debut }} au {{ $saison->date_fin }}</td>
                                        <td>
                                          
                                            <a href="#" title="Modifier" onclick="openEditModal('{{ $saison->id }}')"><i class="fas fa-edit text-warning"></i></a>
                                            <a href="#" onclick="confirmDelete('{{ $saison->id }}')" class="text-danger"><i class="fa fa-trash"></i></a>
                                            <form id="delete-form-{{ $saison->id }}" action="{{ route('saisons.destroy', $saison->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
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

<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary >
          <h5 class="modal-title" id="editMatchModalLabel">Modifier la saison</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
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


<script>
     function openEditModal(saisonId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/saisons/${saisonId}/edit`,
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
            title: 'Êtes-vous sûr de vouloir modifier cette saison ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, modifier',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit();
                Swal.fire('Succès!', 'La saison a été modifiée avec succès.', 'success');
            }
        });
    }
    function confirmDelete(saisonId) {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment supprimer cette saison?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/saisons/${saisonId}`, {
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
        Swal.fire('Supprimée!', 'La saison a été supprimée avec succès.', 'success').then(() => {
            window.location.href = data.redirect;
        });
    } else {
        Swal.fire('Désolé', data.message, 'error');
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