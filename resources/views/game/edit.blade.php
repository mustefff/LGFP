<form id="editGameForm" action="{{ route('game.update', $game->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <!-- Form Fields -->
    <div class="form-row">
        <!-- Colonne gauche -->
        <div class="col-md-6">
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
            <div class="form-group mb-3">
                <label for="lieu">Lieu:</label>
                <input type="text" name="lieu" class="form-control" value="{{ $game->lieu }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="journee">Journée:</label>
                <input type="text" name="journee" class="form-control" value="{{ $game->journee }}" required>
            </div>
        </div>
        <!-- Colonne droite -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" value="{{ $game->date }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="heure">Heure:</label>
                <input type="time" name="heure" class="form-control" value="{{ $game->heure }}" required>
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
        </div>
    </div>
</form>


