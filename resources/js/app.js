/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.select2 = require('select2');

import axios from 'axios';
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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        restaurants: [],
        filterRestaurants: [],
        categories: [],
        categorySelect: '',
        plates: [],
        counter: [],
        search: '',
    },
    created : function () {
        

         axios.get('http://127.0.0.1:8000/api/restaurants')
                .then((response)=> {
                 this.restaurants = response.data;
                 this.filterRestaurants = response.data;
                 });


         axios.get('http://127.0.0.1:8000/api/categories')
               .then((response)=> {
                this.categories = response.data;
               console.log(this.categories)
              }
              )
        
     } ,
        


      methods : {


        restaurantFilter: function() {
            this.filterRestaurants =  this.restaurants.filter(restaurant => {
                return  restaurant.name.includes(this.search)
            }) 

        },

         selectRestaurants: function() {
             if(this.categorySelect == '' && this.search == '') {
                 axios.get('http://127.0.0.1:8000/api/restaurants')
                .then((response)=> {
                 this.restaurants = response.data;
                 this.filterRestaurants = response.data;    
                });
             } else {
                 axios
                 .get('http://127.0.0.1:8000/api/restaurants/' + app.categorySelect)
                 .then((response)=> {
                    this.filterRestaurants = response.data;
             }
             )
           }
            
         },

        getRestaurantPlates: function(restaurant_id) {
            axios
            .get('http://127.0.0.1:8000/api/plates/'+ restaurant_id)
            .then((response)=> {
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
             console.log(this.plates[i].counter);
             console.log(this.plates);

        },

        decreaseCounter: function(i) {
            this.plates[i].counter -= 1;
            this.counter = this.plates[i].counter;
            console.log(this.plates[i].counter);
            console.log(this.plates);

            if (this.counter == 0)

            return this.counter; // controllo su sottrazione piatti lato carrello

       },




    }


});


