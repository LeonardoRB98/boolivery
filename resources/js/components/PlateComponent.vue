<template>
    <div class="container">
        <h1>Hello I am a plate</h1>
        <p>{{ name }}</p>
        <p>{{ counter }}</p>
        <button v-on:click="decreaseCounter()">Decrease</button>
        <button v-on:click="increaseCounter()">Increase</button>
    </div>
</template>

<script>
    export default {
        name: 'plate-component',
        props: {
            'name': {
                type: String
            }
        },
        components: {

        },
        data: function () {
            return {
                counter: 0
            }
        },
        methods: {
            increaseCounter() {
                this.counter += 1;
            },
            decreaseCounter() {
                if (this.counter <= 0) {
                    this.counter = 0;
                } else {
                    this.counter -= 1;
                }
            }
        }
    }
</script>




// // The shopping cart component
// Vue.component('shopping-cart', {
//   props: ['items'],

//   computed: {
//     Total() {
//       let total = 0;
//       this.items.forEach(item => {
//         total += (item.price * item.qty);
//       });
//       return total;
//     }
//   },

//   methods: {
// 		// Remove item by its index
//     removeItem(index) {
//       this.items.splice(index, 1)
//     }
//   }
// })

// const vm = new Vue({
//   el: '#app',
	
//   data: {
//     cartItems: [],
//     items : products
//   },
	
//   methods: {
// 		// Add Items to cart
//     addToCart(itemToAdd) {
//       let found = false;

//       // Add the item or increase qty
// 			let itemInCart = this.cartItems.filter(item => item.id===itemToAdd.id);
// 			let isItemInCart = itemInCart.length > 0;

//       if (isItemInCart === false) {
//         this.cartItems.push(Vue.util.extend({}, itemToAdd));
//       } else {
// 				itemInCart[0].qty += itemToAdd.qty;
// 			}
			
// 			itemToAdd.qty = 1;
//     }
//   }
// })

