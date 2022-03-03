<template>
  <div id="app">
    <vs-navbar center-collapsed v-model="active">
      <template #left>
        <vs-navbar-item :active="active == 'docs'" id="docs">
          <a href="https://github.com/Binboukami/devola" target="blank">
            Documentation
          </a>
        </vs-navbar-item>
      </template>
      <img src="/logo2.png" alt="DEVOLA" />
      <template #right>
        <vs-button icon
          ><a href="https://github.com/Binboukami" target="blank"></a
          ><i class="bx bxl-github"></i
        ></vs-button>
        <vs-button>
          <a href="mailto:luiz.butkeivicz@gmail.com" target="blank">Contact</a>
        </vs-button>
      </template>
    </vs-navbar>

    <vs-dialog :loading="this.loading" v-model="addForm">
      <template #header>
        <h4>Add a new todo item</h4>
      </template>
      <form
        class="con-form todo-form-add"
        @submit.prevent="addTodoItem"
        ref="todoForm"
      >
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
          label-placeholder="What you need to do?"
          class="todo-form__content"
        >
        </vs-input>

        <vs-input
          type="date"
          v-model="newTodo.date"
          label-placeholder="When it is due? (optional)"
          class="todo-form__date"
        >
        </vs-input>
        <div class="footer-dialog">
          <vs-button block type="submit" value="submit"> Add </vs-button>
          <vs-button block @click.prevent="resetForm"> Cancel </vs-button>
        </div>
      </form>
    </vs-dialog>

    <!-- If there are no todos -->
    <vs-row
      justify="center"
      class="todos todos-empity"
      v-if="!this.$getTodos.length"
    >
      <vs-col w="12">
        <h2>Ops!</h2>
        <i class="todos-empity__icon bx bx-bot"></i>
        <h4>Looks like you don't have any pending todo items.</h4>
        <p>This might be a good or bad thing.</p>

        <h5>Try adding something new to do!</h5>
      </vs-col>
      <vs-col class="app-interactions" w="12">
        <vs-button @click="addForm = !addForm" icon> Add new todo </vs-button>
      </vs-col>
    </vs-row>

    <!-- If there are todos -->
    <vs-row
      class="todos"
      id="todos"
      justify="center"
      v-if="this.$getTodos.length"
    >
      <vs-col class="app-interactions" w="10">
        <vs-button @click="addForm = !addForm" icon>
          <i class="bx bx-plus-medical"> </i>Add todo
        </vs-button>
      </vs-col>
      <vs-col
        xs="12"
        sm="10"
        lg="8"
        v-for="todo in this.$getTodos"
        :key="todo.id"
      >
        <todoItem
          :todo="todo"
          @toggleStatus="updateTodoStatus(todo)"
          @edit="updateTodoItem(todo)"
          @update="watchInput($event, todo)"
          @delete="deleteTodo(todo)"
        ></todoItem>
      </vs-col>
    </vs-row>

    <vs-row class="todos" id="todos" justify="center">
      <vs-col
        xs="12"
        sm="10"
        lg="8"
        v-for="todo in this.$getDoneTodos"
        :key="todo.id"
      >
        <todoItem
          :todo="todo"
          :editMode="editMode"
          @toggleStatus="updateTodoStatus(todo)"
          @edit="updateTodoItem(todo)"
          @update="watchInput($event, todo)"
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
  data() {
    return {
      active: false,
      loading: false,
      addForm: false,
      newTodo: {
        title: "",
        content: "",
        date: null,
      },
      editMode: false,
    };
  },
  async created() {
    await this.getTodos();
  },
  methods: {
    async addTodoItem(e: any) {
      if (!this.newTodo) {
        return;
      }
      this.validateForm(e);
      this.loading = true;
      await this.addTodo({ ...this.newTodo, isDone: false, editMode: false });
      this.resetForm();
    },
    async updateTodoItem(todo: any) {
      if (todo.is_editing) {
        await this.updateTodo(todo);
      }
      todo.is_editing = !todo.is_editing;
    },
    watchInput(input: any, todo: any) {
      let propName = input.name;
      todo[propName] = input.value;
      console.log(todo[propName]);
    },
    validateForm(e: any) {
      if (this.newTodo.title) {
        return;
      } else {
        console.log(`Error: ${e}`);
      }
      e.preventDefault;
    },
    resetForm(): void {
      this.newTodo = {
        title: "",
        content: "",
        date: null,
      };
      this.loading = false;
      this.addForm = false;
    },
    ...mapMutations([]),
    ...mapActions([
      "getTodos",
      "addTodo",
      "updateTodoStatus",
      "updateTodo",
      "deleteTodo",
    ]),
  },
  computed: {
    ...mapGetters(["$getTodos", "$getDoneTodos"]),
  },
});
</script>

<style lang="scss">
@import "./scss/index.scss";
</style>
