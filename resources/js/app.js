/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.select2 = require('select2');

import axios from 'axios';
import { forEach } from 'lodash';
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
        cart: []
    },
    created: function () {
        
        // load all restaurants
        axios
            .get('http://127.0.0.1:8000/api/restaurants')
            .then( response => {
                 this.restaurants = response.data;
                 this.filteredRestaurants = response.data;
            });

        // load all categories
        axios
            .get('http://127.0.0.1:8000/api/categories')
            .then( response => {
                this.categories = response.data;
            });

        this.$root.$on('addToCart', (id, counter) => {
            var object = { 
                id: id,
                counter: counter
            };
            this.cart.forEach(plate => {
                if (plate.id == id) {
                    plate.counter = counter;
                } else {
                    this.cart.push(object);
                    console.log(this.cart);
                }
            });
        


            
            
            console.log('Adding product with id:' + id + " and counter " + counter);
        });

        this.$root.$on('removeFromCart', (id, counter) => {
            console.log('Removing product with id:' + id + " and counter " + counter);
            var object = { 
                id: id,
                counter: counter
            };
        });
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

        getRestaurantPlates: function(restaurant_id) {
            axios
                .get('http://127.0.0.1:8000/api/plates/'+ restaurant_id)
                .then(response => {
                    this.restaurants = response.data;
                    for (var i = 0; i < response.data.length; i++ ) {
                        response.data[i].counter = 0;
                    }
                    this.plates = response.data;
                });  
        },

        increaseCounter: function(i) {
             this.plates[i].counter += 1;
             this.counter = this.plates[i].counter;
        },

        decreaseCounter: function(i) {
            this.plates[i].counter -= 1;
            this.counter = this.plates[i].counter;
            if (this.counter == 0)

            return this.counter; // controllo su sottrazione piatti lato carrello

       },




    }


});


