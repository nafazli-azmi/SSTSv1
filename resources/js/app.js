require('./bootstrap.js');


import 'bootstrap';


window.Vue = require('vue');
window.Fire = new Vue();
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue'

//component
Vue.component('role', require('./components/role.vue').default)

Vue.component('user', require('./components/user.vue').default)

Vue.component('loading', require('./components/loading.vue').default)

Vue.component('lect', require('./components/lect.vue').default)


//VFORM
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Momentjs & Filter
  import moment from 'moment';

  Vue.filter("date", function(created){
    return moment(created).format('Do MMMM YYYY'); 
  });

// Vue Toastr
  import VueToastr from "vue-toastr";
  Vue.use(VueToastr, {
    defaultTimeout: 4000,
    defaultPosition: "toast-top-center",
    defaultProgressBar: true,
    defaultProgressBarValue: 0,
  });

// SweetAlert
    import Swal from 'sweetalert2'
    window.swal = Swal;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

  window.toast = Toast;



  const app = new Vue({
    el: '#app' 
});