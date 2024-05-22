@extends('layouts.app_admin')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header text-center" >
                    <h2 style="color: #066666">Créer un Gestionnaire d'Équipe</h2>
                </div>
                <div class="card-body p-5">
                    <form id="adminForm" action="{{ route('admin.create') }}" method="POST" enctype="multipart/form-data" onsubmit="return confirmCreation()">
                        @csrf
                        <div class="form-group">
                            <label for="prenom"> Prénom:</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name"> Nom:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"></i> Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password"></i> Mot de Passe:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nationalite"></i> Nationalité:</label>
                            <input type="text" name="nationalite" id="nationalite" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="date_naissance"> Date de Naissance:</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                        </div>
                        <div class="form-group">
                            <label for="equipe_id"> Équipe:</label>
                            <select name="equipe_id" id="equipe_id" class="form-control" required>
                                @foreach($equipes as $equipe)
                                    <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo"> Photo:</label>
                            <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*" required>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="confirmCreation()" class="btn btn-primary">Créer Gestionnaire d'Équipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmCreation() {
        var email = document.getElementById('email').value;

        if (checkExistingEmail(email)) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'L\'email saisi existe déjà. Veuillez en choisir un autre.'
            });
            return false;
        }

        var prenom = document.getElementById('prenom').value;
        var name = document.getElementById('name').value;
        var password = document.getElementById('password').value;
        var nationalite = document.getElementById('nationalite').value;
        var date_naissance = document.getElementById('date_naissance').value;
        var equipe_id = document.getElementById('equipe_id').value;
        var photo = document.getElementById('photo').value;

        if (prenom === '' || name === '' || email === '' || password === '' || nationalite === '' || date_naissance === '' || equipe_id === '' || photo === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez remplir tous les champs avant de créer un gérant d\'équipe.'
            });
            return false;
        } else {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir créer ce gestionnaire d\'équipe ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, ajouter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('adminForm').submit();
                    Swal.fire('Le gestionnaire d\'équipe a été créé avec succès!', '', 'success');
                }
            });
            return false;
        }
    }

    function checkExistingEmail(email) {
        var existingEmails = {!! json_encode($existingEmails) !!};
        return existingEmails.includes(email);
    }
</script>

@endsection
