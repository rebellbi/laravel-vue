<template>
  <div>
    <div class="container">
      <h2>ระบบบันทึกข้อมูล</h2>
      <form action="/user">
        <div class="form-group">
          <label>ชื่อ: </label>
          <input type="text" class="form-control" v-model="name" />
        </div>
        <div class="form-group">
          <label>เมือง: </label>
          <input type="text" class="form-control" v-model="city" />
        </div>
        <div class="form-group">
          <button class="btn btn-primary" @click="addNewUser()">
            เพิ่มข้อมูล
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      city: "",
    };
  },
  methods: {
    addNewUser() {
      axios.post("/api/user", {
        name: this.name,
        city: this.city,
      });
    },
  },
};
</script>

<style>
</style>