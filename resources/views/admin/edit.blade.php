<div class="card-body">
    <form action="{{ route('admin.update', $gestionnaire->id) }}" id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" class="form-control" value="{{ $gestionnaire->prenom }}" required>
        </div>
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" name="name" class="form-control" value="{{ $gestionnaire->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $gestionnaire->email }}" required>
        </div>
        <div class="form-group">
            <label for="nationalite">Nationalité:</label>
            <input type="text" name="nationalite" class="form-control" value="{{ $gestionnaire->nationalite }}" required>
        </div>
        <div class="form-group">
            <label for="date_naissance">Date de Naissance:</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ $gestionnaire->date_naissance }}" required>
        </div>
        <div class="form-group">
            <label for="equipe_id">Équipe:</label>
            <select name="equipe_id" class="form-control" required>
                @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}" @if($gestionnaire->equipe_id == $equipe->id) selected @endif>{{ $equipe->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" name="photo" class="form-control-file" accept="image/*">
        </div>
       
    </form>
</div>