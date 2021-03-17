/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.select2 = require('select2');

import axios from 'axios';
import { forEach, isEmpty } from 'lodash';
import Vue from 'vue';


jQuery(function () {
    $('.js-select_categories').select2();
});
// jQuery(function () {
//     $('.js-select_categories').select2();
// });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('plate-component', require('./components/PlateComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        restaurants: [],
        filteredRestaurants: [],
        categories: [],
        categorySelect: '',
        plates: [],
        counter: [],
        search: '',
        cart: [],
        currentRestaurantId: ''
    },
    created: function () {

        // load all restaurants
        axios
            .get('http://127.0.0.1:8000/api/restaurants')
            .then( response => {
                 this.restaurants = response.data;
                 this.filteredRestaurants = response.data;
            }
        );

        // load all categories
        axios
            .get('http://127.0.0.1:8000/api/categories')
            .then( response => {
                this.categories = response.data;
            }
        );
        // recupero id dalla schermata show tramite <script>var id = {!! json_encode($restaurant->id) !!};</script>
        this.currentRestaurantId = window.id;

        // caricamento piatti singolo ristorate show
        axios
        .get('http://127.0.0.1:8000/api/plates/'+ this.currentRestaurantId)
            .then(response => {
                this.restaurants = response.data;
                for (var i = 0; i < response.data.length; i++ ) {
                    response.data[i].counter = 0;
                }
                this.plates = response.data;
                console.log();
            }
        );



        this.$root.$on('addToCart', (id, counter, price) => {
            // oggetto da pushare
            var object = {
                id: id,
                counter: counter,
                price: price
            };
            // inzializzo var a false se l'id dell'object è presente nel carello lo cambio a true
            var changed = false;
            // salva la posizione del object già presente nel carrello inizializzata a -1 per evitare conflitti
            var k = -1;

            for(let i= 0; i< this.cart.length; i++) {
                // se trovo un oggetto con id uguale a quello dell'oggetto da pushre eseguo le operazioni nelle parentesi graffe
                //ed interrompo il loop
                if(this.cart[i].id == id) {
                    changed = true;
                    k = i;
                    break;
                }
            }
            // se changed è true sovrascrivo l'object
            if(changed == true) {
                this.cart[k] = object;
            // altrimenti lo pusho!
            } else {
                this.cart.push(object);
            }
            // JSON.parse(localstorage.cart)
            // this.cart = JSON.parse(localStorage.cart);
            console.log(this.cart);
            console.log('Adding product with id:' + id + " and counter " + counter);
        });

        this.$root.$on('removeFromCart', (id, counter, price) => {
            console.log('Removing product with id:' + id + " and counter " + counter);
            var object = {
                id: id,
                counter: counter,
                price: price
            };
            var k = -1;

            for(let i= 0; i< this.cart.length; i++) {
                // se trovo un oggetto con id uguale a quello dell'oggetto da pushre eseguo le operazioni nelle parentesi graffe
                //ed interrompo il loop
                if(this.cart[i].id == id) {
                    k = i;
                    break;
                }
            }
            if(counter == 0) {
                // rimuovi oggetto
                this.cart.splice(k, 1);
            } else {
                this.cart[k] = object;
            }
            // this.cart = JSON.parse(localStorage.cart);
            console.log(this.cart);
        });
    },
    mounted: function() {
        if(localStorage.cart) {
            this.cart = JSON.parse(localStorage.cart);
        }
    },
    watch: {
        cart(object) {
           localStorage.cart = JSON.stringify(object);
        }
    },
    methods: {

        // get restaurants by selected category and selected name
        // include option of more categories?
        searchRestaurants: function() {
            axios
                .get('http://127.0.0.1:8000/api/restaurants/' + app.categorySelect)
                .then(response => {
                    // maybe add uppercase/lowercase inclusion
                    this.filteredRestaurants = response.data.filter(restaurant => {
                        return  restaurant.name.includes(this.search)
                });
             })
        },

        // getRestaurantPlates: function(restaurant_id) {
        //     axios
        //         .get('http://127.0.0.1:8000/api/plates/'+ restaurant_id)
        //         .then(response => {
        //             this.restaurants = response.data;
        //             for (var i = 0; i < response.data.length; i++ ) {
        //                 response.data[i].counter = 0;
        //             }
        //             this.plates = response.data;
        //         }
        //     );
        // },
    }


});


