/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        title:"",
        name_product:"",
        vendor_code:"",
        urls:[]        
    },
    methods: {
        get_product_value:function(id){
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + php_token;
            let formData = new FormData();
            let urlSend = 'api/product/'+id;
            axios.get(urlSend, formData, {
                }).then(function (response) {
                    console.log(response);
                    app.title = "Данные продукта - полное JSON представление"
                    app.name_product = response.data.product.name_product
                    app.vendor_code = response.data.product.vendor_code
                    app.urls = response.data.urls
                    $('#exampleModal').modal('show')
                })
                .catch(function (error) {
                    console.log(error);                             
            });
        }
    }
});
