@extends('layouts.app_admin')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div >
                <div class="card-header  text-center">
                    <h3 style="color: #006666">Créer une Nouvelle Activité</h3>
                </div>
                <div class="card-body">
                    <form id="activiteForm" method="POST" action="{{ route('activite.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <!-- Form Fields -->

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="temps_jeu">Temps de jeu:</label>
                                <input type="number" name="temps_jeu" id="temps_jeu" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="type_activite">Type d'activité:</label>
                                <input type="text" name="type_activite" id="type_activite" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="game_id">Sélectionner le match:</label>
                                <select name="game_id" id="game_id" class="form-control" required>
                                    <option value="">Sélectionner un match</option>
                                    @foreach($games as $game)
                                        <option value="{{ $game->id }}">
                                            @if($game->homeTeam && $game->awayTeam)
                                                {{ $game->homeTeam->nom }} vs {{ $game->awayTeam->nom }}
                                            @else
                                                Match non défini
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="joueur_id">Sélectionner le joueur:</label>
                                <select name="joueur_id" id="joueur_id" class="form-control" required>
                                    <option value="">Sélectionner un joueur</option>
                                    @foreach($joueurs as $joueur)
                                        <option value="{{ $joueur->id }}">
                                            @if($joueur->nom)
                                                {{ $joueur->nom }}
                                            @else
                                                Joueur non défini
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="saison_id">Sélectionner la saison:</label>
                                <select name="saison_id" id="saison_id" class="form-control" required>
                                    <option value="">Sélectionner une saison</option>
                                    @foreach($saisons as $saison)
                                        <option value="{{ $saison->id }}">
                                            @if($saison->libelle)
                                                {{ $saison->libelle }}
                                            @else
                                                saison non défini
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="text-center mt-4">
                            <button onclick="validateForm()" type="button" class="btn btn-primary btn-lg">Enregistrer</button>
                            <a href="{{ route('activite.index') }}" class="btn btn-outline-light">Annuler</a>
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
       
        color: white;
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
    
    }
    
    .text-center {
        margin-top: 4%;
    }
</style>





<script>
    function validateForm() {
        let tempsJeu = document.getElementById('temps_jeu').value;
        let typeActivite = document.getElementById('type_activite').value;
        let gameId = document.getElementById('game_id').value;
        let joueurId = document.getElementById('joueur_id').value;
        let saisonId = document.getElementById('saison_id').value;
        if (tempsJeu === '' || typeActivite === '' || gameId === '' || joueurId === '' || saisonId === '') {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez remplir tous les champs avant de créer une activité.'
            });
        } else {
            document.getElementById('activiteForm').submit();
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'L\'activité a été créée avec succès.'
            });
        }
    }
</script>

@endsection