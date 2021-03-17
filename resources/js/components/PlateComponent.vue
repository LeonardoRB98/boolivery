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
                plateId: this.id
            }
        },
        methods: {
            decreaseCounter() {
                if (this.counter <= 0) {
                    this.counter = 0;
                } else {
                    this.counter -= 1;
                    this.$root.$emit('removeFromCart', this.plateId, this.counter)

                }
                
            },
            increaseCounter() {
                this.counter += 1;
                this.$root.$emit('addToCart', this.id, this.counter)
            }
        }
    }
</script>



