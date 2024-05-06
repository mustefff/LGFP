<form id="editJoueurForm" action="{{ route('joueurs.update', $joueur->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <!-- Vos champs de formulaire ici -->
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $joueur->prenom }}" required>
            </div>
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $joueur->nom }}" required>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de Naissance:</label>
                <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ $joueur->date_naissance }}" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" class="form-control-file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="taille">Taille (cm):</label>
                <input type="number" class="form-control" id="taille" name="taille" value="{{ $joueur->taille }}">
            </div>
            <div class="form-group">
                <label for="poids">Poids (kg):</label>
                <input type="number" class="form-control" id="poids" name="poids" value="{{ $joueur->poids }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nationalite">Nationalité:</label>
                <input type="text" class="form-control" id="nationalite" name="nationalite" value="{{ $joueur->nationalite }}" required>
            </div>
            <div class="form-group">
                <label for="debut_carriere">Début de Carrière:</label>
                <input type="date" class="form-control" id="debut_carriere" name="debut_carriere" value="{{ $joueur->debut_carriere }}">
            </div>
            <div class="form-group">
                <label for="poste">Poste:</label>
                <input type="text" class="form-control" id="poste" name="poste" value="{{ $joueur->poste }}" required>
            </div>
            <div class="form-group">
                <label for="num_maillot">Numéro de Maillot:</label>
                <input type="number" class="form-control" id="num_maillot" name="num_maillot" value="{{ $joueur->num_maillot }}">
            </div>
            <div class="form-group">
                <label for="saison_id">Saison:</label>
                <select class="form-control" id="saison_id" name="saison_id" required>
                    @foreach($saisons as $saison)
                        <option value="{{ $saison->id }}" {{ $joueur->saison_id == $saison->id ? 'selected' : '' }}>{{ $saison->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="equipe_id">Équipe:</label>
                <select class="form-control" id="equipe_id" name="equipe_id" required>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe->id }}" {{ $joueur->equipe_id == $equipe->id ? 'selected' : '' }}>{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
