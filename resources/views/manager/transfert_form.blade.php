@extends('layouts.app_gequipe')

@section('content')
<div class="container animate__animated animate__fadeIn">
    <div class="form-container">
        <h4 class="form-title">Proposer un transfert</h4>
        <form action="{{ route('mjoueurs.proposeTransfert') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <label for="num_maillot">Numéro de maillot</label>
                <input type="text" class="form-control" id="num_maillot" name="num_maillot" required>
            </div>
            <div class="form-group mb-4">
                <label for="duree_contrat">Durée du contrat</label>
                <input type="text" class="form-control" id="duree_contrat" name="duree_contrat">
            </div>
           
            <div class="form-group mb-4">
                <label for="equipe_id">Équipe de Destination</label>
                <select class="form-control" id="equipe_id" name="equipe_id" required>
                    @foreach($equipes as $equipe)
                    <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="joueur_id">Joueur à Transférer</label>
                <select class="form-control" id="joueur_id" name="joueur_id" required>
                    @foreach($joueurs as $joueur)
                    <option value="{{ $joueur->id }}">{{ $joueur->prenom }} {{ $joueur->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="document_contrat">Document du contrat (PDF)</label>
                <input type="file" class="form-control" id="document_contrat" name="document_contrat" accept="application/pdf">
            </div>
            <div class="form-group mb-4">
                <label for="examen_medical_reussi">Examen médical</label>
                <select class="form-control" id="examen_medical_reussi" name="examen_medical_reussi" required>
                    <option value="1">Réussi</option>
                    <option value="0">Échoué</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Proposer</button>
        </form>
    </div>
</div>

<style>
/* custom.css */

.form-container {
    background: #fff;
    padding: 50px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    width: 100%;
    max-width: 1400px;
}

.form-container:hover {
    transform: scale(1.03);
}

.form-group label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border-radius: 10px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    height: 50px;
}

.btn-primary {
    background: linear-gradient(45deg, #066666);
    border: none;
    border-radius: 10px;
    transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
    padding: 15px 30px;
    font-size: 18px;
    width: 100%;
}

.form-title {
    text-align: center;
    margin-bottom: 30px;
    font-weight: bold;
    color: #066666;
    text-transform: uppercase;
    letter-spacing: 1px;
}

</style>
@endsection
