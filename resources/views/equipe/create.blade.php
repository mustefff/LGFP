@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="form-title" style="color: #006666">Ajouter une Nouvelle Équipe</h2>
            <form id="createForm" action="{{ route('equipe.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom de l'équipe:</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="photo">Photo de l'équipe:</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
                <div class="form-group">
                    <label for="ville">Ville:</label>
                    <input type="text" class="form-control" id="ville" name="ville" required>
                </div>
                <div class="form-group">
                    <label for="budget">Budget:</label>
                    <input type="number" step="0.01" class="form-control" id="budget" name="budget" required>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="validateAndSubmit()">Enregistrer</button>
                    <a href="{{ route('equipe.index') }}" class="btn">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateAndSubmit() {
        let nom = document.getElementById('nom').value;
        let ville = document.getElementById('ville').value;
        let budget = document.getElementById('budget').value;

        if (nom === '' || ville === '' || budget === '') {
            Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
        } else {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir ajouter cette nouvelle équipe ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, ajouter',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('createForm').submit();
                    Swal.fire('Succès!', 'La nouvelle équipe a été ajoutée avec succès.', 'success');
                }
            });
        }
    }
</script>


<script>
    function confirmCreation() {
        Swal.fire({
            title: 'Êtes-vous sûr de vouloir ajouter cette nouvelle équipe ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, ajouter',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('createForm').submit();
                Swal.fire('Succès!', 'La nouvelle équipe a été ajoutée avec succès.', 'success');
            }
        });
    }
</script>





<style>
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
    }
    .form-title {
        font-size: 24px;
        font-weight: bold;
      
        margin-bottom: 30px;
        text-align: center;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }
    .form-control:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .btn-primary {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-secondary {
        color: black;
        background-color: white;
        border-color: #6c757d;
    }
    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    .text-center {
        text-align: center;
    }
</style>
@endsection
