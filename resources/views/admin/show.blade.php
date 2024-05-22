<div class="card-body">
    <div class="row">
        <div class="col-md-4 text-center">
            @if($gestionnaire->photo)
                <img src="{{ Storage::url($gestionnaire->photo) }}" alt="Photo de {{ $gestionnaire->nom }}" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
            @else
                <span class="text-muted">Aucune photo disponible</span>
            @endif
        </div>
        <div class="col-md-8">
            <p><strong>Prénom :</strong> {{ $gestionnaire->prenom }}</p>
            <p><strong>Nom :</strong> {{ $gestionnaire->name }}</p>
            <p><strong>Email :</strong> {{ $gestionnaire->email }}</p>
            <p><strong>Statut :</strong> {{ $gestionnaire->statut }}</p>
            <p><strong>Équipe :</strong> {{ $gestionnaire->equipe->nom }}</p>
            <p><strong>Date de Naissance :</strong> {{ $gestionnaire->date_naissance }}</p>
            <p><strong>Nationalité :</strong> {{ $gestionnaire->nationalite }}</p>
        </div>
    </div>
</div>