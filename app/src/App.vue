<template>
  <div id="app">
    <div class="center examplex">
      <vs-navbar
        not-line
        color="#7d33ff"
        text-white
        square
        center-collapsed
        v-model="active"
      >
        <vs-navbar-item :active="active == 'todos'" id="todos">
          Todos
        </vs-navbar-item>
        <vs-navbar-item>
          <vs-button class="navbar__button" animation-type="vertical">
            <i class="bx bxs-quote-alt-right"></i>
            <template #animate> Devola </template>
          </vs-button>
        </vs-navbar-item>
        <vs-navbar-item :active="active == 'license'" id="license">
          Github
        </vs-navbar-item>
      </vs-navbar>
      <div class="square">
        <div class="child">child 1</div>
        <div class="child">child 2</div>
      </div>
    </div>

    <vs-dialog :loading="this.animState.loading" v-model="addForm">
      <template #header>
        <h4>Add a new todo item</h4>
      </template>
      <form class="con-form" @submit="addTodo" ref="todoForm">
        <vs-input
          class="todo-form__title"
          v-model="newTodo.title"
          label-placeholder="Title"
          required
        >
        </vs-input>

        <vs-input
          type="text"
          ref="todoInput"
          v-model="newTodo.content"
          required
          label-placeholder="What you need to do?"
          class="todo-form__content"
        >
        </vs-input>

        <vs-input
          type="date"
          v-model="newTodo.date"
          label-placeholder="When it is due? (optional)"
          class="todo-form__content"
        >
        </vs-input>
        <div class="footer-dialog">
          <vs-button block type="submit" value="submit"> Add </vs-button>
          <vs-button block @click.prevent="resetForm"> Cancel </vs-button>
        </div>
      </form>

      <template #footer> </template>
    </vs-dialog>

    <vs-row class="center grid">
      <vs-col vs-type="flex" w="12">
        <h1>VueJS CRUD Application</h1>
      </vs-col>

      <vs-tooltip>
        <vs-button @click="addForm = !addForm" icon>
          <i class="bx bx-plus-medical"></i>
        </vs-button>
        <template #tooltip> Add new </template>
      </vs-tooltip>
    </vs-row>

    <vs-row class="todos" id="todos" justify="center">
      <vs-col w="12">
        <h1>Todos</h1>
      </vs-col>
      <vs-col
        xs="12"
        sm="10"
        lg="8"
        v-for="todo in this.$getTodo"
        :key="todo.id"
      >
        <todoItem
          :todo="todo"
          :editMode="editMode"
          @edit="editMode = !editMode"
          @update="updateTodo($event, todo)"
          @delete="deleteTodo(todo)"
        ></todoItem>
      </vs-col>
    </vs-row>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import { mapGetters, mapMutations, mapActions } from "vuex";
import todoItem from "./components/todoItem.vue";

export default Vue.extend({
  name: "App",
  components: { todoItem },
  mounted() {
    this.getLocalStorage();
  },
  methods: {
    async updateTodo(input: any, todo: any) {
      let propName = input.name;
      todo[propName] = input.value;
      console.log(todo[propName]);
      await this.setLocalStorage();
    },
    async addTodo(e: any) {
      if (!this.newTodo) {
        return;
      }
      await this.updateLocalStorage(this.newTodo);
      // this.validateForm(e);
      this.resetForm();
    },
    validateForm(e: any) {
      if (this.newTodo.title && this.newTodo.content) {
        return;
      } else {
        console.log("erro");
      }
      e.preventDefault;
    },
    resetForm(): void {
      this.newTodo = {
        id: Date.now,
        title: "",
        content: "",
        date: null,
        status: false,
      };
      this.addForm = !this.addForm;
    },
    ...mapMutations([]),
    ...mapActions([
      "getLocalStorage",
      "setLocalStorage",
      "updateLocalStorage",
      "deleteTodo",
    ]),
  },
  data() {
    return {
      active: false,
      animState: {
        loading: false,
      },
      addForm: false,
      newTodo: {
        id: Date.now,
        title: "",
        content: "",
        date: null,
        status: false,
      },
      editMode: false,
    };
  },
  computed: {
    ...mapGetters(["$getTodo"]),
  },
});
</script>

<style lang="scss">
@import "./scss/index.scss";
#app {
}
</style>
