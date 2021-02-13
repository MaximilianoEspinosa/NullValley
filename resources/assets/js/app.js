require('./bootstrap');
window.Vue = require('vue');

import Vuetify from 'vuetify';
Vue.use(Vuetify);

//Para formatos de fechas
import moment from 'moment';
// {{fecha | formatTimestamp}}

Vue.filter('formatTimestamp', function(value) {
  	if (value) {
    	return moment(String(value)).format('DD/MM/YYYY - hh:mm a');
  	}
});

import VModal from 'vue-js-modal';
Vue.use(VModal);

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('detalle-karateca', require('./components/DetalleKarateca.vue'));
Vue.component('modal-votacion', require('./components/ModalVotacion.vue'));
Vue.component('comentarios', require('./components/Comentarios.vue'));

const app = new Vue({
    el: '#app'
});