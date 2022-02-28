import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    todos: Array(0),
  },
  getters: {
    $getTodo: (state) => {
      return state.todos.filter((todo) => {
        return todo.status == false;
      });
    },
  },
  mutations: {
    deleteTodo(state, payload) {
      state.todos.splice(state.todos.indexOf(payload), 1);
    },
    getLocalStorage(state) {
      if (localStorage.length > 0 && localStorage.todos) {
        state.todos = JSON.parse(localStorage.todos);
      }
      // Tratativa de erro
    },
    setLocalStorage(state) {
      if (state.todos) {
        localStorage.setItem("todos", JSON.stringify(state.todos));
      }
    },
    updateLocalStorage(state, payload) {
      if (state.todos) {
        state.todos.push({ ...payload, id: Date.now() });
      }
    },
  },
  actions: {
    async deleteTodo({ commit, dispatch }, payload) {
      await commit("deleteTodo", payload);
      await dispatch("setLocalStorage");
    },
    async getLocalStorage({ commit }) {
      await commit("getLocalStorage");
    },
    async setLocalStorage({ commit }) {
      await commit("setLocalStorage");
    },
    async updateLocalStorage({ commit, dispatch }, payload) {
      await commit("updateLocalStorage", payload);
      await dispatch("setLocalStorage");
    },
  },
  modules: {},
});
