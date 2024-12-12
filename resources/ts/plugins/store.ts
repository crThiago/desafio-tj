import { createStore } from "vuex";

const alert = {
    namespaced: true,
    state: {
        show: false,
        message: '',
        type: 'success',
    },
    mutations: {
        show(state, payload) {
            state.show = true
            state.message = payload.message
            state.type = payload.type
        },
        hide(state) {
            state.show = false
            state.message = ''
            state.type = 'success'
        }
    }
}

const store = createStore({
    modules: {
        alert
    }
});

export default store;
