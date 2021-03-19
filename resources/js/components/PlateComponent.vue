<template>
    <div class="plate shadow">
        <div class="plate_photo plate_photo_trigger">

            <!-- <img :src="'{{url('/storage')}}' + '/' + restaurant.photo" :alt="restaurant.name"> -->
        </div>
        <div class="plate_utility">
            <div class="plate_info">
                <h5 class="plate_name">{{ name }}</h5>
                <h5 class="plate_price">€ {{ price }}</h5>
            </div>

            <div class="plate_description">
                <h5>INGREDIENTI</h5>
                <p>{{ description }}</p>
            </div>
        </div>
        <div class="plate_counter">
            <span class="plate_add" v-on:click="increaseCounter()"><i class="fas fa-plus-square"></i></span>
            <span class="plate_remove" v-on:click="decreaseCounter()"><i class="fas fa-minus-square"></i></span>
        </div>
        <!-- <div class="photo"></div>
        <p>Prezzo: {{ price }} €</p>
        <button v-on:click="increaseCounter()">Add</button>
        <span>{{ counter }}</span>
        <button v-on:click="decreaseCounter()">Remove</button> -->
    </div>
</template>

<script>
    export default {
        name: 'plate-component',
        props: {
            'name': {
                type: String
            },
            'id': {
                type: Number
            },
            'price': {
                type: Number
            },
            'description': {
                type: String
            },
            'photo': {
                type: String
            },

        },
        components: {

        },
        data: function () {
            return {
                counter: 0,
                plateId: this.id,
                platePrice: this.price,
                plateName: this.name,
                plateDescription: this.description,
                platePhoto: this.photo,

            }
        },
        mounted: function() {
            if(localStorage.cart) {
                var savedCart = JSON.parse(localStorage.cart);
                for(var i = 0; i < savedCart.length; i++) {
                    console.log(savedCart[i]);
                    if(savedCart[i].id == this.plateId) {
                        this.counter = savedCart[i].counter;
                    }
                }
            }
        },
        methods: {
            decreaseCounter() {
                if (this.counter <= 0) {
                    this.counter = 0;
                } else {
                    this.counter -= 1;
                    this.$root.$emit('removeFromCart', this.plateId, this.counter, this.platePrice, this.plateName)

                }

            },
            increaseCounter() {
                this.counter += 1;
                this.$root.$emit('addToCart', this.plateId, this.counter,this.platePrice,this.plateName)
            },

        }
    }
</script>



