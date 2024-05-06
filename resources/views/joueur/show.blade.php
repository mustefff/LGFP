<div class="card-body" style="background-color: #f8f9fa; border-radius: 15px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
    <div class="row">
        <div class="col-md-4 text-center">
            @if($joueur->photo)
                <img src="{{ Storage::url($joueur->photo) }}" alt="Photo de {{ $joueur->prenom }} {{ $joueur->nom }}" class="img-fluid" style="width: 200px; height: 200px; object-fit: cover; border: 5px solid #6c757d;">
            @else
                <div class="bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 200px; height: 200px; border: 5px solid #6c757d;">
                    Aucune photo
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <h3 style="color: #6c757d; font-weight: bold;">{{ $joueur->prenom }} {{ $joueur->nom }}</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="background-color: #e9ecef;"><strong>Date de Naissance:</strong> {{ $joueur->date_naissance }}</li>
                <li class="list-group-item"><strong>Taille:</strong> {{ $joueur->taille }} cm</li>
                <li class="list-group-item" style="background-color: #e9ecef;"><strong>Poids:</strong> {{ $joueur->poids }} kg</li>
                <li class="list-group-item"><strong>Nationalité:</strong> {{ $joueur->nationalite }}</li>
                <li class="list-group-item" style="background-color: #e9ecef;"><strong>Début de Carrière:</strong> {{ $joueur->debut_carriere }}</li>
                <li class="list-group-item"><strong>Poste:</strong> {{ $joueur->poste }}</li>
                <li class="list-group-item" style="background-color: #e9ecef;"><strong>Numéro de Maillot:</strong> {{ $joueur->num_maillot }}</li>
                <li class="list-group-item"><strong>Saison:</strong> {{ $joueur->saison ? $joueur->saison->libelle : 'Saison non définie' }}</li>
                <li class="list-group-item" style="background-color: #e9ecef;"><strong>Équipe:</strong> {{ $joueur->equipe ? $joueur->equipe->nom : 'Équipe non définie' }}</li>
            </ul>
        </div>
    </div>
</div>
