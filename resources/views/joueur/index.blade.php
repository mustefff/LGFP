@extends('layouts.app_admin')

@section('content')
<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6 col-sm-6 col-6">
            <div class="btn-group">
                <a href="{{ route('joueurs.create') }}" id="addRow" class="btn btn-primary">
                    Ajouter un Joueur <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4" style="background-color: white;">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Équipe</th>
                <th>Saison</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($joueurs as $joueur)
            <tr class="odd gradeX">
                <td class="patient-img">
                    @if($joueur->photo)
                    <img src="{{ Storage::url($joueur->photo) }}" alt="Photo de {{ $joueur->nom }}" style="width: 50px; height: auto; border-radius: 50%;">
                    @else
                    <span>Aucune photo disponible</span>
                    @endif
                </td>
                <td>{{ $joueur->prenom }}</td>
                <td>{{ $joueur->nom }}</td>
                <td>{{ $joueur->equipe ? $joueur->equipe->nom : 'Équipe non définie' }}</td>
                <td>{{ $joueur->saison ? $joueur->saison->libelle : 'Saison non définie' }}</td>
                <td>
                    <a href="#" onclick="openDetailsModal('{{ $joueur->id }}')" title="Voir Détails"><i class="fas fa-eye text-info"></i></a>
                   
                    <a href="#" title="Modifier" onclick="openEditModal('{{ $joueur->id }}')"><i class="fas fa-edit text-warning"></i></a>
                    <a href="#" title="Supprimer" onclick="confirmDelete({{ $joueur->id }})"><i class="fas fa-trash-alt text-danger"></i></a>
                    <form id="delete-form-{{ $joueur->id }}" action="{{ route('joueurs.destroy', $joueur->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Aucun joueur trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal fade animate__animated animate__fadeIn" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white>
          <h5 class="modal-title" id="editMatchModalLabel">Modifier le joueur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="editMatchModalBody">
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" onclick="submitForm()" class="btn btn-primary">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>


    <div class="modal fade animate__animated animate__fadeIn " id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white >
                <h5 class="modal-title" id="detailsModalLabel">Détails du Joueur</h5>
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
    function openDetailsModal(joueurId) {
    $.ajax({
        url: `/joueurs/${joueurId}`,
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
   
   function openEditModal(joueurId) {
    // Utiliser AJAX pour charger la vue HTML
    $.ajax({
        url: `/joueurs/${joueurId}/edit`,
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
function submitForm() {
    // Vérifications ici (si nécessaire)

    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Vous êtes sur le point d'enregistrer les modifications.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, enregistrer!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Soumettre le formulaire spécifique par son ID
            document.getElementById('editJoueurForm').submit();
        }
    });
}

function confirmDelete(joueurId) {
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Vous ne pourrez pas revenir en arrière après cette action!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + joueurId).submit();
        }
    });
}
</script>
@endsection