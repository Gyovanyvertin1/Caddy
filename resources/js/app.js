import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import flatpickr from "flatpickr";

import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'
window.Alpine = Alpine

Alpine.plugin(mask)

 
Alpine.start()