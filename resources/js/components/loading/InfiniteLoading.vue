<template>
  <div class="container">
    <h1>Infinite Loading</h1>
    <draggable
      tag="ul"
      :list="students"
      v-bind="dragOptions"
      @start="drag = true"
      @end="drag = false"
      class="list-group"
      handle=".handle"
    >
      <transition-group type="transition" :name="!drag ? 'flip-list' : null">
        <li
          class="list-group-item"
          v-for="(item, $index) in students"
          :key="$index"
          :data-num="$index + 1"
        >
          <div class="drag-option">
            <b-button class="arrows handle" variant="outline-secondary">
              <font-awesome-icon icon="arrows-alt" />
            </b-button>
            <font-awesome-icon icon="th-list" class="list" />
          </div>

          <div class="drag-content">
            <h2>{{ item.name }}</h2>
            <h4>{{ item.dob }}</h4>
            <h6>
              {{ item.email }} | {{ item.phone === "" ? "empty" : item.phone }}
            </h6>
          </div>
        </li>
      </transition-group>
    </draggable>

    <infinite-loading
      spinner="spiral"
      @infinite="infiniteHandler"
    ></infinite-loading>
  </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
export default {
  components: {
    InfiniteLoading,
  },
  data() {
    return {
      page: 1,
      students: [],
      drag: false,
      lastId: 0,
    };
  },
  methods: {
    infiniteHandler($state) {
      axios.get("api/student?last_id=" + this.lastId).then(({ data }) => {
        if (data.length) {
          this.page += 1;
          this.students.push(...data);
          this.lastId = this.students[this.students.length - 1].id;
          $state.loaded();
        } else {
          $state.complete();
        }
      });
    },
  },
  computed: {
    dragOptions() {
      axios.put("/api/student/" + this.lastId, {
        students: this.students,
      });
      return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
        scrollSensitivity: 200,
        forceFallback: true,
      };
    },
  },
};
</script>

<style>
.list {
  margin: 11px;
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
.drag-option {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 5px;
  width: 120px;
}
.drag-content {
  width: 100%;
}
</style>