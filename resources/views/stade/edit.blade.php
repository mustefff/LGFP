<form id="editStadeForm" action="{{ route('stade.update', $stade->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nom">Nom du Stade:</label>
        <input type="text" name="nom" id="nom" class="form-control" value="{{ $stade->nom }}" required>
    </div>
    <div class="form-group">
        <label for="emplacement">Emplacement:</label>
        <input type="text" name="emplacement" id="emplacement" class="form-control" value="{{ $stade->emplacement }}" required>
    </div>
    <div class="form-group">
        <label for="capacite">Capacité:</label>
        <input type="number" name="capacite" id="capacite" class="form-control" value="{{ $stade->capacite }}" required>
    </div>
   
</form>