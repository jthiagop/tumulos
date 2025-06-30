// resources/js/metronic-init.js

import jquery from 'jquery';
import moment from 'moment';
import 'bootstrap';

// A única tarefa deste arquivo é preparar o ambiente global
window.$ = window.jQuery = jquery;
window.moment = moment;

console.log('Ambiente Global (jQuery, Moment) preparado.');