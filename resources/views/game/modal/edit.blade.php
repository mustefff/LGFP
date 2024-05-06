{{-- game/modal/edit.blade --}}

<!-- Modal -->
<div class="modal fade" id="editGameModal" tabindex="-1" role="dialog" aria-labelledby="editGameModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGameModalLabel">Modifier le Match</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'édition -->
                <!-- Début du formulaire d'édition -->
<form id="editGameForm" action="{{ route('game.update', $game->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <!-- Champs du formulaire -->
    <div class="form-group mb-3">
        <label for="home_team_id">Équipe à Domicile:</label>
        <select name="home_team_id" class="form-control" required>
            @foreach($equipes as $equipe)
                <option value="{{ $equipe->id }}" {{ $equipe->id == $game->home_team_id ? 'selected' : '' }}>{{ $equipe->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="away_team_id">Équipe à l'Extérieur:</label>
        <select name="away_team_id" class="form-control" required>
            @foreach($equipes as $equipe)
                <option value="{{ $equipe->id }}" {{ $equipe->id == $game->away_team_id ? 'selected' : '' }}>{{ $equipe->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-row">
        <div class="form-group mb-3">
            <label for="date">Date:</label>
            <input type="date" name="date" class="form-control" value="{{ $game->date }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="heure">Heure:</label>
            <input type="time" name="heure" class="form-control" value="{{ $game->heure }}" required>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="lieu">Lieu:</label>
        <input type="text" name="lieu" class="form-control" value="{{ $game->lieu }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="journee">Journée:</label>
        <input type="text" name="journee" class="form-control" value="{{ $game->journee }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="stade_id">Stade:</label>
        <select name="stade_id" class="form-control" required>
            @foreach($stades as $stade)
                <option value="{{ $stade->id }}" {{ $stade->id == $game->stade_id ? 'selected' : '' }}>{{ $stade->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="saison_id">Saison:</label>
        <select name="saison_id" class="form-control" required>
            @foreach($saisons as $saison)
                <option value="{{ $saison->id }}" {{ $saison->id == $game->saison_id ? 'selected' : '' }}>{{ $saison->libelle }}</option>
            @endforeach
        </select>
    </div>

    <!-- Boutons d'action -->
    <div class="text-center mt-4">
        <button type="button" onclick="confirmUpdate()" class="btn btn-primary">Enregistrer les Modifications</button>
        <a href="{{ route('game.index') }}" class="btn btn-outline-light">Annuler</a>
    </div>
</form>
<!-- Fin du formulaire d'édition -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" onclick="confirmUpdate()" class="btn btn-primary">Enregistrer les Modifications</button>
            </div>
        </div>
    </div>
</div>

