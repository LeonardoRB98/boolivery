/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// select 2
window.select2 = require('select2');
//chart js
// import Chart from 'chart.js';
window.chart = require('chart.js');

import axios from 'axios';
import { forEach, isEmpty } from 'lodash';
import Vue from 'vue';
import vueScrollto from 'vue-scrollto'

Vue.use(vueScrollto)


jQuery(function () {
    $('.js-select_categories').select2();
});

$(document).ready(function(){
	$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});
});

$(window).resize(function () {
    $('#desktopCartNoDeskop').addClass('display_none');
});
// $('.plate_photo_trigger').click(function() {
//     this.$('.plate_photo_trigger').toggle();
// });

// $(".plate_photo_trigger").click(function () {
//     $('.plate_photo_trigger').addClass('display_none');
// });

// jQuery(function ().click {
//     $('#plate_photo_trigger').toggle();
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
        urlPath: 'http://127.0.0.1:8000',
        isLoading: true,
        restaurants: [],
        filteredRestaurants: [],
        categories: [],
        categorySelect: '',
        sponsoredRestaurant: true,
        plates: [],
        search: '',
        cart: [],
        currentRestaurantId: '',
        totalPrice: 0,
        // TRIGGER VIEW CART ON MOBILE
        hiddenCart: true,
        hiddenPaymentCart: true,
        classImage: "",
        totalCartItems: 0,
    },
    created: function () {
        // load all restaurants
        axios
            .get(this.urlPath + '/api/restaurants')
            .then( response => {
                 this.restaurants = response.data;
                 this.filteredRestaurants = response.data;
            }
        );
        // load all categories
        axios
            .get(this.urlPath + '/api/categories')
            .then( response => {
                this.categories = response.data;
                this.categories.forEach(element => {
                    element.show = true;
                });

                console.log(this.categories);
            }
        );

        // recupero id dalla schermata show tramite <script>var id = {!! json_encode($restaurant->id) !!};</script>
        this.currentRestaurantId = window.id;

        // caricamento piatti singolo ristorate show
        axios
        .get(this.urlPath + '/api/plates/'+ this.currentRestaurantId)
            .then(response => {
                this.restaurants = response.data;
                for (var i = 0; i < response.data.length; i++ ) {
                    response.data[i].counter = 0;
                }
                this.plates = response.data;
            }
        );

        this.$root.$on('addToCart', (id, counter, price, name) => {
            // oggetto da pushare
            var object = {
                id: id,
                counter: counter,
                price: price,
                name: name
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
                // SOLUZIONE 1
                this.cart.splice(k, 1, object);
                // this.cart[k] = object;
            // altrimenti lo pusho!
            } else {
                this.cart.push(object);
            }

            this.totalPrice = Number((this.totalPrice + price).toFixed(2));

            this.totalCartItems +=1;
        });

        this.$root.$on('removeFromCart', (id, counter, price, name) => {
            var object = {
                id: id,
                counter: counter,
                price: price,
                name: name
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
                // this.cart[k] = object;
                // SOLUZIONE 1
                this.cart.splice(k, 1, object);
            }

            this.totalPrice = Number((this.totalPrice - price).toFixed(2));

            this.totalCartItems -= 1;

        });

    },
    mounted: function() {

        this.changeClass();

        if(localStorage.cart) {
            this.cart = JSON.parse(localStorage.cart);

        }

        // totale nel local storage
        if(localStorage.totalPrice) {
            this.totalPrice = parseFloat(localStorage.totalPrice);
        }

        if (localStorage.totalCartItems) {
            this.totalCartItems = parseInt(localStorage.totalCartItems);
        }

        this.isLoading = false
    },
    watch: {
        // SOLUZIONE 1
        cart: {
            handler(newCart) {
                localStorage.cart = JSON.stringify(newCart);
            },
            deep: true
        },
        totalPrice: {
            handler(newTotal) {
                localStorage.totalPrice = newTotal;
            },
            deep: true
        },
        totalCartItems: {
            handler(newTotalCartItems) {
                localStorage.totalCartItems = newTotalCartItems;
            },
        }
    },

    methods: {
        searchInputRestaurants() {
            axios
                .get(this.urlPath + '/api/restaurants/')
                .then(response => {
                    // maybe add uppercase/lowercase inclusion
                    this.filteredRestaurants = response.data.filter(restaurant => {
                        this.categorySelect = '';
                        return  restaurant.name.toLowerCase().includes(this.search.toLowerCase());
                });
            })
        },

        searchRestaurants() {
            axios
                .get(this.urlPath + '/api/restaurants/' + app.categorySelect)
                .then(response => {
                    // maybe add uppercase/lowercase inclusion

                    this.filteredRestaurants = response.data;
                });

        },

        buttonRestaurants(category) {
            this.categorySelect = category;
            this.searchRestaurants();
            this.search = '';
            this.sponsoredRestaurant = false;
            this.categories.forEach(element => {
                if (element.show != true) {
                    element.show = true;
                }
            });
        },

        sponsoredRestaurants() {
            this.search = '';
            this.categorySelect = '';
            this.sponsoredRestaurant = true;

            this.categories.forEach(element => {
                element.show = true;
            });

            axios
            .get(this.urlPath + '/api/restaurants')
            .then( response => {
                 this.restaurants = response.data;
                 this.filteredRestaurants = response.data;
            });
        },

        // functions for cart and plates
        add(plateId, plateCounter, platePrice, plateName) {
            // aggiorniamo i counter del piatto e del carrello
            var newPlateCounter = plateCounter + 1;
            this.$root.$emit('addToCart', plateId, newPlateCounter, platePrice, plateName);
            this.$root.$emit('addToComponent', plateId, newPlateCounter);
        },
        remove(plateId, plateCounter, platePrice, plateName) {
            // aggiorniamo i counter del piatto e del carrello
            if  (plateCounter > 0) {
                var newPlateCounter = plateCounter - 1;
                this.$root.$emit('removeFromCart', plateId, newPlateCounter, platePrice, plateName);
                this.$root.$emit('removeFromComponent', plateId, newPlateCounter);
            }
        },
        // empty trash
        trashCart() {
            this.cart = [];
            localStorage.removeItem('cart');
            this.totalPrice = 0;
            localStorage.removeItem('totalPrice');
            this.$root.$emit('resetCounter');
            this.totalCartItems = 0;
        },

        // CALCOLO TOTALE SINGOLO PIATTO
        calculatePrice(counter , price) {
            return this.formatFix(counter*price);
        },

        formatFix(price) {
            return price.toFixed(2);
        },
        changeClass() {
            setInterval(function(){
                app.classImage = "go";
            }, 800);
        }

    }

});


