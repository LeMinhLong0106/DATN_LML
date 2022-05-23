let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

import {
    createStore
} from "vuex";

const store = createStore({

    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
    },

    mutations: {
        addToCart(state, item) {
            // console.log(item);
            let found = state.cart.find(a => a.id == item.id);

            if (found) { //if item is already in cart
                found.quantity++;
                found.totalPrice = found.quantity * found.gia;
            } else { //if item is not in cart 
                state.cart.push(item);

                item.quantity = 1;
                item.totalPrice = item.gia;
            }

            state.cartCount++;
            // console.log(state.cart);
            this.commit('saveCart');
        },

        addCart(state, item) {
            // console.log(item);
            let found = state.cart.find(a => a.id == item.id);
            if (found) { //if item is already in cart
                found.quantity += item.quantity;
                found.note = item.note;
                found.totalPrice = found.quantity * found.gia;
            } else { //if item is not in cart
                state.cart.push(item);
                item.quantity = item.quantity;
                item.note = item.note;
                item.totalPrice = item.quantity * item.gia;
            }
            this.commit('saveCart');
        },

        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let a = state.cart[index];
                state.cartCount -= a.quantity;

                state.cart.splice(index, 1);
            }
            this.commit('saveCart');

        },

        updateSoluong(state, item) {
            let found = state.cart.find(a => a.id == item.id);

            found.quantity = item.quantity;
            found.totalPrice = found.quantity * found.gia;

            // console.log(state.cart);
            this.commit('saveCart');
        },
        // lưu cart vào localStorage 
        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        },

        clearCart(state) {
            state.cart = [];
            state.cartCount = 0;
            this.commit('saveCart');
        },


    }

});

export default store;