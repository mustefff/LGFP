@extends('layouts.app_admin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div >
                <div class="card-header text-center">
                    <h2 style="color: #006666">Créer un Nouveau Stade</h2>
                </div>
                <div class="card-body">
                    <form id="createStadeForm" action="{{ route('stade.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom du Stade:</label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="emplacement">Emplacement:</label>
                            <input type="text" name="emplacement" id="emplacement" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="capacite">Capacité:</label>
                            <input type="number" name="capacite" id="capacite" class="form-control" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" onclick="confirmCreate()" class="btn btn-primary">Créer le Stade</button>
                            <a href="{{ route('stade.index') }}" class="btn btn-outline-light">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
       
        padding: 20px 0;
        font-size: 28px;
        font-weight: 300;
        letter-spacing: 1px;
    }
    .card-body {
        padding: 2rem;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    label {
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: .5rem;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        padding: .75rem 1rem;
        font-size: 1rem;
    }
    .btn-primary, .btn-outline-light {
        padding: .75rem 1.5rem;
        border-radius: 5px;
        font-size: 1rem;
        margin-right: 1rem;
        width: auto; /* Adjust the width as needed */
    }
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
    }
    .btn-outline-light {
        background-color: transparent;
        border-color: #fff;
        color: #3498db;
    }
    .text-center {
        margin-top: 4%;
    }
</style>





<script>
function confirmCreate() {
    let nom = document.querySelector('input[name="nom"]').value;
    let emplacement = document.querySelector('input[name="emplacement"]').value;
    let capacite = document.querySelector('input[name="capacite"]').value;

    if (nom.trim() === '' || emplacement.trim() === '' || capacite.trim() === '') {
        Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
    } else {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment créer ce stade?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, créer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('createStadeForm').submit();
                Swal.fire('Créé!', 'Le stade a été créé avec succès.', 'success');
            }
        });
    }
}
</script>
@endsection