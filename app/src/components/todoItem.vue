<template>
  <div id="todoItem">
    <vs-card type="1" :class="['todo-card']">
      <template #text>
        <div class="todo-card__checkbox">
          <vs-checkbox
            class="todo-card__status"
            @click="$emit('delete')"
            :value="todo.status"
            name="status"
          ></vs-checkbox>
        </div>
        <div class="todo-card__content">
          <vs-input
            type="date"
            class="todo-card__edit-field edit-field__date"
            v-if="editMode"
            :value="todo.date"
            name="date"
            @change="$emit('update', $event.target)"
          >
          </vs-input>

          <h5 v-if="!editMode">{{ todo.date }}</h5>
          <vs-input
            class="todo-card__edit-field edit-field__title"
            v-if="editMode"
            :value="todo.title"
            name="title"
            @change="$emit('update', $event.target)"
          >
          </vs-input>
          <h3 v-if="!editMode">
            {{ todo.title }}
          </h3>
          <vs-input
            class="todo-card__edit-field edit-field__content"
            v-if="editMode"
            :value="todo.content"
            name="content"
            @change="$emit('update', $event.target)"
          >
          </vs-input>
          <p v-if="!editMode">{{ todo.content }}</p>
        </div>
        <div class="todo-card__interactions">
          <vs-tooltip>
            <vs-button icon>
              <i
                :class="['bx', editMode ? 'bx-check' : 'bxs-pencil']"
                @click="$emit('edit')"
              ></i>
            </vs-button>
            <template #tooltip>
              {{ editMode ? "Confirm" : "Edit" }}
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
    editMode: Boolean,
  },
};
</script>

<style lang="scss"></style>
