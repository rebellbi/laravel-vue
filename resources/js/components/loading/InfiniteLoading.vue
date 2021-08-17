<template>
  <div class="container">
    <div>
      <span>Infinite Loading</span>
      <button class="btn btn-outline-secondary" type="reset">reset</button>
      <button class="btn btn-info" @click="saveOrder">save</button>
    </div>

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
          class="list-group-item rounded-bottom-20 rounded-top-20"
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
      sorted: [],
    };
  },
  methods: {
    infiniteHandler($state) {
      axios.get("api/student?page=" + this.page).then(({ data }) => {
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
    saveOrder() {
      let getSorted = this.sorted.filter((data,i) => {
        return data.id !== data.seq
      })
      axios
        .put("/api/student/" + this.lastId, {
          sorted_students: getSorted,
        })
        .then((res) => {
          console.log('success')
        })
        .catch((err) => {
          alert(err.message);
        });
    },
  },
  computed: {
    dragOptions() {
      this.sorted = this.students.map((data,i) => {
        return {
          id: i+1,
          seq: data.seq
        }
      })
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
.rounded-bottom-20 {
  border-bottom-left-radius: 20px !important;
  border-bottom-right-radius: 20px !important;
}
.rounded-top-20 {
  border-top-right-radius: 20px !important;
  border-top-left-radius: 20px !important;
}
</style>