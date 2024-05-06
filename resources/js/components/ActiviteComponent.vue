<template>
  <div>
    <form @submit.prevent="submitForm" class="form">
      <div class="form-group">
        <label for="temps_jeu">Temps de jeu:</label>
        <input v-model="activite.temps_jeu" type="number" id="temps_jeu" class="form-control" placeholder="Temps de jeu" required>
      </div>
      <div class="form-group">
        <label for="type_activite">Type d'activité:</label>
        <input v-model="activite.type_activite" type="text" id="type_activite" class="form-control" placeholder="Type d'activité" required>
      </div>
      <div class="form-group">
        <label for="match_id">ID du match:</label>
        <input v-model="activite.match_id" type="number" id="match_id" class="form-control" placeholder="ID du match" required>
      </div>
      <div class="form-group">
        <label for="joueur_id">ID du joueur:</label>
        <input v-model="activite.joueur_id" type="number" id="joueur_id" class="form-control" placeholder="ID du joueur" required>
      </div>
      <button type="submit" class="btn btn-primary">Créer Activité</button>
    </form>
  </div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      activite: {
        temps_jeu: '',
        type_activite: '',
        match_id: '',
        joueur_id: '',
      },
    };
  },
  methods: {
    submitForm() {
      Swal.fire({
        title: 'Confirmez-vous la création de l\'activité?',
        showCancelButton: true,
        confirmButtonText: 'Confirmer',
        cancelButtonText: 'Annuler',
      }).then((result) => {
        if (result.isConfirmed) {
          // Logique pour soumettre le formulaire
        }
      });
    }
  }
}
</script>

<style scoped>
.form {
  max-width: 400px;
  margin: 0 auto;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
}

input {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  box-sizing: border-box;
}

.btn {
  background-color: #007bff;
  color: white;
  padding: 8px 15px;
  border: none;
  cursor: pointer;
}

.btn:hover {
  background-color: #0056b3;
}
</style>