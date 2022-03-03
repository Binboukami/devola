import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    todos: Array(0),
  },
  getters: {
    $getTodos: (state) => {
      return state.todos.filter((f: any) => f.is_done == false);
    },
    $getDoneTodos: (state) => {
      return state.todos.filter((f: any) => f.is_done == true);
    },
  },
  mutations: {
    getTodos(state) {
      Vue.axios.get("/todos").then((res: any) => {
        state.todos = res.data;
      });
    },
    addTodo(state, payload) {
      Vue.axios.post("/todos", payload);
    },
    updateTodoStatus(state, payload) {
      payload.is_done = !payload.is_done;
    },
    updateTodo(state, payload) {
      Vue.axios.put(`/todos/${payload.id}`, payload);
    },
    deleteTodo(state, payload) {
      Vue.axios.delete(`/todos/${payload.id}`);
    },
  },
  actions: {
    async getTodos({ commit }) {
      await commit("getTodos");
    },
    async addTodo({ commit, dispatch }, payload) {
      await commit("addTodo", payload);
      alert(`Sucessfully added new todo`);
      await dispatch("getTodos");
    },
    updateTodoStatus({ commit, dispatch }, payload) {
      commit("updateTodoStatus", payload);
      dispatch("updateTodo", payload);
    },
    async updateTodo({ commit, dispatch }, payload) {
      await commit("updateTodo", payload);
    },
    async deleteTodo({ commit, dispatch }, payload) {
      if (
        confirm(
          `Are you sure you want to delete ${payload.title.toUpperCase()}?\nThis action cannot be undone once it is completed.`
        )
      ) {
        await commit("deleteTodo", payload);
        dispatch("getTodos");
      }
      return;
    },
  },
  modules: {},
});
