import {
    createStore
} from "vuex";

const store = createStore({
    state: {
        quyen: [],
    },

    getters: {
        quyen: state => state.quyen,
    },

    actions: {
        quyen({
            commit
        }, quyen) {
            commit("quyen", quyen);
        }
    },

    mutations: {
        quyen(state, data) {
            state.quyen = data;
        }
    }

});

export default store;