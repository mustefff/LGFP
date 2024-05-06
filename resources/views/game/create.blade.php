@extends('layouts.app_admin')

@section('content')
<div class="container my-5 p-5 shadow" style="background: #fff;"> 
    <div class="row justify-content-center">
        <div class="col-md-10"> 
            <div> 
                <div class="card-header text-center" >
                    <h2 style="color: #006666">Créer un Nouveau Match</h2>
                </div>
                <div class="card-body">
                    <form id="createMatchForm" action="{{ route('game.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <!-- Form content -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="home_team_id">Équipe A:</label>
                                    <select name="home_team_id" class="form-control" required>
                                        @foreach($equipes as $equipe)
                                            <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="away_team_id">Équipe B:</label>
                                    <select name="away_team_id" class="form-control" required>
                                        @foreach($equipes as $equipe)
                                            <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="heure">Heure:</label>
                                    <input type="time" name="heure" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lieu">Lieu:</label>
                                    <input type="text" name="lieu" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="journee">Journée:</label>
                                    <input type="text" name="journee" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="stade_id">Stade:</label>
                                    <select name="stade_id" class="form-control" required>
                                        @foreach($stades as $stade)
                                            <option value="{{ $stade->id }}">{{ $stade->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="saison_id">Saison:</label>
                                    <select name="saison_id" class="form-control" required>
                                        @foreach($saisons as $saison)
                                            <option value="{{ $saison->id }}">{{ $saison->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" onclick="confirmCreate()" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('game.index') }}" class="btn btn-outline-light">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
        margin-bottom: 30px;
        padding: 20px 0;
        font-size: 30px;
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
       
    }
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        color: white;
        padding: .75rem 1.5rem;
        border-radius: 5px;
        font-size: 1rem;
        margin-right: 1rem;
    }
    .btn-outline-light {
        background-color: transparent;
        border-color: #fff;
        color: #3498db;
        padding: .75rem 1.5rem;
        border-radius: 5px;
        font-size: 1rem;
    }
</style>




<script>
function confirmCreate() {
    let homeTeam = document.querySelector('select[name="home_team_id"]').value;
    let awayTeam = document.querySelector('select[name="away_team_id"]').value;
    let date = document.querySelector('input[name="date"]').value;
    let heure = document.querySelector('input[name="heure"]').value;
    let lieu = document.querySelector('input[name="lieu"]').value;
    let journee = document.querySelector('input[name="journee"]').value;
    let stade = document.querySelector('select[name="stade_id"]').value;
    let saison = document.querySelector('select[name="saison_id"]').value;

    if (homeTeam.trim() === '' || awayTeam.trim() === '' || date.trim() === '' || heure.trim() === '' || lieu.trim() === '' || journee.trim() === '' || stade.trim() === '' || saison.trim() === '') {
        Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
    } else {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: 'Voulez-vous vraiment créer ce match?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, créer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('createMatchForm').submit();
                Swal.fire('Créé!', 'Le match a été créé avec succès.', 'success');
            }
        });
    }
}
</script>
@endsection