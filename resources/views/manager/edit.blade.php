
    <div class="card-body">
        <form action="{{ route('joueur.update', $joueur->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" name="description" id="description" rows="5" required>{{ $joueur->description }}</textarea>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="dribbles" class="form-label">Dribbles:</label>
                        <input type="number" class="form-control touchspin-input" name="dribbles" id="dribbles" value="{{ $joueur->dribbles }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="passes" class="form-label">Passes:</label>
                        <input type="number" class="form-control touchspin-input" name="passes" id="passes" value="{{ $joueur->passes }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="duel" class="form-label">Duel:</label>
                        <input type="number" class="form-control touchspin-input" name="duel" id="duel" value="{{ $joueur->duel }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="tirs_bloques" class="form-label">Tirs bloqués:</label>
                        <input type="number" class="form-control touchspin-input" name="tirs_bloques" id="tirs_bloques" value="{{ $joueur->tirs_bloques }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 touchspin-wrapper">
                        <label for="interception" class="form-label">Interception:</label>
                        <input type="number" class="form-control touchspin-input" name="interception" id="interception" value="{{ $joueur->interception }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="abord" class="form-label">Abord:</label>
                        <input type="number" class="form-control touchspin-input" name="abord" id="abord" value="{{ $joueur->abord }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="recouvrement" class="form-label">Recouvrement:</label>
                        <input type="number" class="form-control touchspin-input" name="recouvrement" id="recouvrement" value="{{ $joueur->recouvrement }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="dernier_homme" class="form-label">Dernier homme:</label>
                        <input type="number" class="form-control touchspin-input" name="dernier_homme" id="dernier_homme" value="{{ $joueur->dernier_homme }}" required>
                    </div>
                    <div class="mb-3 touchspin-wrapper">
                        <label for="degagement" class="form-label">Dégagement:</label>
                        <input type="number" class="form-control touchspin-input" name="degagement" id="degagement" value="{{ $joueur->degagement }}" required>
                    </div>
                </div>
            </div>
            
        </form>
    </div>


<!-- Ajout des dépendances JS et initialisation de TouchSpin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-touchspin/4.3.0/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialisation de TouchSpin avec des couleurs différentes pour chaque champ
        $('#dribbles').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-primary',
            buttonup_class: 'btn btn-outline-primary'
        });
        $('#passes').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-secondary',
            buttonup_class: 'btn btn-outline-secondary'
        });
        $('#duel').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-success',
            buttonup_class: 'btn btn-outline-success'
        });
        $('#tirs_bloques').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-danger',
            buttonup_class: 'btn btn-outline-danger'
        });
        $('#interception').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-warning',
            buttonup_class: 'btn btn-outline-warning'
        });
        $('#abord').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-info',
            buttonup_class: 'btn btn-outline-info'
        });
        $('#recouvrement').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-dark',
            buttonup_class: 'btn btn-outline-dark'
        });
        $('#dernier_homme').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-light',
            buttonup_class: 'btn btn-light'
        });
        $('#degagement').TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            buttondown_class: 'btn btn-outline-primary',
            buttonup_class: 'btn btn-outline-primary'
        });
    });
</script>

