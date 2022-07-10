import {
    createStore
} from "vuex";

const store = createStore({
    state: {
        quyen: [],
        user: null,
    },

    getters: {
        quyen: state => state.quyen,
        user(state) {
            return state.user;
        },
    },

    actions: {
        quyen({
            commit
        }, quyen) {
            commit("quyen", quyen);
        },
        user: ({
            commit
        }, user) => {
            commit('user', user);
        },
    },

    mutations: {
        quyen(state, data) {
            state.quyen = data;
        },
        user(state, user) {
            state.user = user;
        },
    }

});

export default store;