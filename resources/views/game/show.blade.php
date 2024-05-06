<div class="card-body ">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="px-3 py-2">
                <h4 style="color: #006666">Équipes</h4>
                <p><strong>Équipe A:</strong> {{ $game->homeTeam->nom }}</p>
                <p><strong>Équipe B:</strong> {{ $game->awayTeam->nom }}</p>
                <h4 style="color: #006666">Horaire</h4>
                <p><strong>Date:</strong> {{ $game->date }}</p>
                <p><strong>Heure:</strong> {{ $game->heure }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="px-3 py-2">
                <h4 style="color: #006666">Lieu</h4>
                <p><strong>Stade:</strong> {{ $game->stade->nom }}</p>
                <p><strong>Lieu:</strong> {{ $game->lieu }}</p>
                <h4 style="color: #006666">Saison</h4>
                <p><strong>Journée:</strong> {{ $game->journee }}</p>
                <p><strong>Saison:</strong> {{ $game->saison->libelle }}</p>
            </div>
        </div>
    </div>
</div>