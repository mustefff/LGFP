<form id="editForm" action="{{ route('equipe.update', $equipe->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nom" class="form-label">Nom de l'équipe:</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{ $equipe->nom }}" required>
        <div class="invalid-feedback">
            Veuillez entrer un nom d'équipe.
        </div>
    </div>
    <div class="form-group">
        <label for="ville" class="form-label">Ville:</label>
        <input type="text" class="form-control" id="ville" name="ville" value="{{ $equipe->ville }}" required>
        <div class="invalid-feedback">
            Veuillez entrer une ville.
        </div>
    </div>
    <div class="form-group">
        <label for="budget" class="form-label">Budget:</label>
        <input type="number" step="0.01" class="form-control" id="budget" name="budget" value="{{ $equipe->budget }}" required>
        <div class="invalid-feedback">
            Veuillez entrer un budget.
        </div>
    </div>
</form>