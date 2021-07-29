<template>
  <div class="container">
    <h2>Todo list</h2>
    <div v-if="todos.length === 0">
      <span>ไม่มี todo ในขณะนี้</span>
    </div>
    <div v-else>
      <draggable
        tag="ul"
        :list="todos"
        v-bind="dragOptions"
        @start="drag = true"
        @end="drag = false"
        class="list-group"
        handle=".handle"
      >
        <transition-group type="transition" :name="!drag ? 'flip-list' : null">
          <li class="list-group-item" v-for="(todo, idex) in todos" :key="idex">
            <b-button class="arrows handle" variant="outline-secondary">
              <font-awesome-icon icon="arrows-alt" />
            </b-button>

            <font-awesome-icon icon="th-list" class="list" />
            <b-form-input type="text" v-model="todo.text" class="input-text" />
            <font-awesome-icon
              icon="times"
              class="times"
              @click="removeTodo(idex)"
            />
          </li>
        </transition-group>
      </draggable>
    </div>
    <b-button class="add-todo" variant="outline-primary" @click="addTodo">
      + เพิ่มตัวเลือก Attribution
    </b-button>
    <hr>
    <span>index list: {{checkSorting()}}</span>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todos: [],
      drag: false,
    };
  },
  mounted() {
    this.countTodo = 0;
  },
  methods: {
    addTodo() {
      this.todos.push({ id: this.countTodo++, text: "Unknown" });
    },
    removeTodo(id) {
      this.todos.splice(id, 1);
    },
    checkSorting(){
        return this.todos.map((data) => data.id)
    }
  },
  computed: {
    dragOptions() {
      return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
      };
    },
  },
};
</script>

<style>
.list-group-item {
  display: flex;
  justify-content: center;
}
.list {
  margin: 11px;
}
.times {
  margin: 11px;
  color: red;
}
.add-todo {
  margin-top: 10px;
  width: 40%;
}
.flip-list-move {
  transition: transform 0.5s;
}
.no-move {
  transition: transform 0s;
}
.ghost {
  opacity: 0.5;
  background: #97ecff;
}
</style>