<template>
  <div id="todoItem">
    <vs-card
      type="1"
      :class="['todo-card', { 'todo-card__done': todo.is_done }]"
    >
      <template #text>
        <div class="todo-card__checkbox">
          <vs-checkbox
            :class="['todo-card__status']"
            @click="$emit('toggleStatus')"
            :value="todo.is_done"
          ></vs-checkbox>
        </div>
        <div class="todo-card__content">
          <vs-input
            type="date"
            class="todo-card__edit-field edit-field__date"
            v-if="todo.is_editing"
            :value="todo.date"
            name="date"
            @change="$emit('update', $event.target)"
          >
          </vs-input>

          <h5 v-if="!todo.is_editing">{{ todo.date }}</h5>
          <vs-input
            class="todo-card__edit-field edit-field__title"
            v-if="todo.is_editing"
            :value="todo.title"
            name="title"
            @change="$emit('update', $event.target)"
          >
          </vs-input>
          <h3 v-if="!todo.is_editing">
            {{ todo.title }}
          </h3>
          <vs-input
            class="todo-card__edit-field edit-field__content"
            v-if="todo.is_editing"
            :value="todo.content"
            name="content"
            @change="$emit('update', $event.target)"
          >
          </vs-input>
          <p v-if="!todo.is_editing">{{ todo.content }}</p>
        </div>
        <div class="todo-card__interactions">
          <vs-tooltip v-if="todo.is_editing">
            <vs-button icon>
              <i :class="['bx', 'bxs-trash']" @click="$emit('delete')"></i>
            </vs-button>
            <template #tooltip>
              {{ "Delete" }}
            </template>
          </vs-tooltip>
          <vs-tooltip>
            <vs-button icon>
              <i
                :class="['bx', todo.is_editing ? 'bx-check' : 'bxs-pencil']"
                @click="$emit('edit')"
              ></i>
            </vs-button>
            <template #tooltip>
              {{ todo.is_editing ? "Confirm" : "Edit" }}
            </template>
          </vs-tooltip>
        </div>
      </template>
    </vs-card>
  </div>
</template>

<script>
export default {
  name: "TodoItem",
  props: {
    todo: {
      type: Object,
    },
  },
};
</script>

<style lang="scss"></style>
