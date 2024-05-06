@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div>
                <div class="card-header">
                    <h2 style="color: #006666">Créer une Nouvelle Saison</h2>
                </div>
                <div class="card-body">
                    <form id="createForm" action="{{ route('saisons.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="libelle">Libellé de la Saison:</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" required>
                        </div>
                        <div class="form-group">
                            <label for="date_debut">Date de Début:</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                        </div>
                        <div class="form-group">
                            <label for="date_fin">Date de Fin:</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary" onclick="validateAndSubmit()">Créer la Saison</button>
                            <a href="{{ route('saison.index') }}" class="btn btn-outline-light">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateAndSubmit() {
        let libelle = document.getElementById('libelle').value;
        let dateDebut = document.getElementById('date_debut').value;
        let dateFin = document.getElementById('date_fin').value;

        if (libelle === '' || dateDebut === '' || dateFin === '') {
            Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
        } else {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir créer cette nouvelle saison ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, créer',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('createForm').submit();
                    Swal.fire('Succès!', 'La nouvelle saison a été créée avec succès.', 'success');
                }
            });
        }
    }
</script>

<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Nunito', sans-serif;
        background-color: #ecf0f1;
    }
    .container {
        width: 100%;
        padding: 2% ;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px white;
    }
    .card {
        border: none;
        border-radius: 10px;
    }
    .card-header {
       
        color:#006666;
        padding: 20px;
        font-size: 24px;
        font-weight: 300;
        text-align: center;
      
    }
    .card-body {
        padding: 30px;
        background-color: #ffffff;
    }
    .form-group {
        margin-bottom: 25px;
    }
    label {
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
    }
    .form-control {
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
        width: 100%;
    }
    .btn-primary, .btn-outline-light {
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 18px;
        margin-right: 10px;
    }
    .btn-primary {
        background-color: #006666;
        border-color: #006666;
        color: white;
    }
    .btn-outline-light {
        background-color: transparent;
        border-color: #fff;
        color: #006666;
    }
    .text-center {
        text-align: center;
        margin-top: 4%;
    }
</style>
@endsection
