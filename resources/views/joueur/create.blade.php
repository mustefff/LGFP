@extends('layouts.app_admin')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="bg-dark text-white p-5 shadow rounded">
                <h2 class="text-center text-primary mb-4">Ajouter un Nouveau Joueur</h2>
                <form action="{{ route('joueurs.store') }}" method="POST" enctype="multipart/form-data" id="addPlayerForm" class="needs-validation" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="infos-personnelles" class="text-primary">Informations Personnelles</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="prenom">Prénom:</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nom">Nom:</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="date_naissance">Date de Naissance:</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nationalite">Nationalité:</label>
                                <input type="text" class="form-control" id="nationalite" name="nationalite" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label for="infos-physiques" class="text-primary">Informations Physiques</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="poids">Poids (kg):</label>
                                <input type="number" class="form-control" id="poids" name="poids" required>
                            </div>
                            <div class="col-md-6">
                                <label for="taille">Taille (cm):</label>
                                <input type="number" class="form-control" id="taille" name="taille" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label for="infos-carriere" class="text-primary">Informations de Carrière</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="poste">Poste:</label>
                                <input type="text" class="form-control" id="poste" name="poste" required>
                            </div>
                            <div class="col-md-6">
                                <label for="debut_carriere">Début de Carrière:</label>
                                <input type="date" class="form-control" id="debut_carriere" name="debut_carriere" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label for="autres-infos" class="text-primary">Autres Informations</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="num_maillot">Numéro de Maillot:</label>
                                <input type="text" class="form-control" id="num_maillot" name="num_maillot" required>
                            </div>
                            <div class="col-md-6">
                                <label for="saison_id">Saison:</label>
                                <select class="form-control" id="saison_id" name="saison_id" required>
                                    <option value="">Sélectionner une saison</option>
                                    @foreach($saisons as $saison)
                                        <option value="{{ $saison->id }}">{{ $saison->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="equipe_id">
                                    <label for="equipe_id">Équipe:</label>
                                <select class="form-control" id="equipe_id" name="equipe_id" required>
                                    <option value="">Sélectionner une équipe</option>
                                    @foreach($equipes as $equipe)
                                        <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="photo">Photo:</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" onclick="validateForm()" class="btn btn-primary">Ajouter le Joueur</button>
                        <a href="{{ route('joueurs.index') }}" class="btn btn-outline-light">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<style>
    .text-primary {
        color: #006666 !important;
    }
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        color: #fff;
        background-color: #0056b3;
        border-color: #0056b3;
    }
    


    body {
        background-color: #343a40 !important;
        width: 100%;

    }
    .bg-dark {
        background-color: white !important;
       
    }
    .text-white {
        color: black !important;
    }
    .btn-outline-light {
        color: black;
        border-color: #f8f9fa;
    }
    .btn-outline-light:hover {
        color: #343a40;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }

</style>





<script>
    function validateForm() {
        event.preventDefault(); // Empêcher l'envoi du formulaire par défaut
        let prenom = document.getElementById('prenom').value;
        let photo = document.getElementById('photo').value;
        let nom = document.getElementById('nom').value;

        if (prenom === '' || nom === '' || photo === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez remplir tous les champs requis.',
            });
        } else {
            Swal.fire({
                title: 'Confirmer l\'enregistrement',
                text: 'Êtes-vous sûr de vouloir ajouter ce joueur?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, ajouter!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addPlayerForm').submit(); // Soumettre le formulaire seulement si l'utilisateur confirme
                    Swal.fire('Succès', 'Le joueur a été ajouté avec succès.', 'success'); // Afficher le Swal de succès après l'ajout
                }
            });
        }
    }
</script>
    
    

@endsection





