<template>
    <div class="container">
        <h1>Hello I am a plate</h1>
        <p>Nome piatto: {{ name }}</p>
        <p>Price: {{ price }}</p>
        <p>Id: {{ id }}</p>

        <button v-on:click="increaseCounter()">Add</button>
        <span>{{ counter }}</span>
        <button v-on:click="decreaseCounter()">Remove</button>
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

        },
        components: {

        },
        data: function () {
            return {
                counter: 0,
                plateId: this.id,
                platePrice: this.price,
                plateName: this.name
            }
        },
        mounted: function() {
            if(localStorage.cart) {
                var savedCart = JSON.parse(localStorage.cart);
                console.log(savedCart);
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
            }
        }
    }
</script>



