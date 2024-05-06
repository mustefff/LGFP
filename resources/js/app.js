import './bootstrap';
import { createApp } from 'vue';
import { Form } from 'vform';
import Swal from 'sweetalert2';

// Assignation de Form et Swal à l'objet window pour un accès global
window.Form = Form;
window.Swal = Swal;

// Création d'une nouvelle instance de l'application Vue
const app = createApp({});

// Importation et enregistrement du composant ActiviteComponent
import ActiviteComponent from './components/ActiviteComponent.vue';
app.component('activite-component', ActiviteComponent);

// Montage de l'application Vue
app.mount('#app');