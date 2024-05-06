<form id="activiteForm" method="POST" action="{{ route('activite.update', $activite->id) }}" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="temps_jeu">Temps de jeu:</label>
            <input type="number" name="temps_jeu" id="temps_jeu" class="form-control" value="{{ $activite->temps_jeu }}" required>
        </div>
        <div class="col-md-6 mb-4">
            <label for="type_activite">Type d'activité:</label>
            <input type="text" name="type_activite" id="type_activite" class="form-control" value="{{ $activite->type_activite }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="game_id">Sélectionner le match:</label>
            <select name="game_id" id="game_id" class="form-control" required>
                <option value="">Sélectionner un match</option>
                @foreach($games as $game)
                    <option value="{{ $game->id }}" {{ $game->id == $activite->game_id ? 'selected' : '' }}>
                        @if($game->homeTeam && $game->awayTeam)
                            {{ $game->homeTeam->nom }} vs {{ $game->awayTeam->nom }}
                        @else
                            Match non défini
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-4">
            <label for="joueur_id">Sélectionner le joueur:</label>
            <select name="joueur_id" id="joueur_id" class="form-control" required>
                <option value="">Sélectionner un joueur</option>
                @foreach($joueurs as $joueur)
                    <option value="{{ $joueur->id }}" {{ $joueur->id == $activite->joueur_id ? 'selected' : '' }}>
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
    
</form>