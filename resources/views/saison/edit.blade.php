<form id="editForm" action="{{ route('saisons.update', $saison->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="libelle">Libellé de la Saison:</label>
        <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $saison->libelle }}" required>
    </div>
    <div class="form-group">
        <label for="date_debut">Date de Début:</label>
        <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $saison->date_debut }}" required>
    </div>
    <div class="form-group">
        <label for="date_fin">Date de Fin:</label>
        <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $saison->date_fin }}" required>
    </div>
    
</form>