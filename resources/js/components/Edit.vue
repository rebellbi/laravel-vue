<template>
  <div>
    <div class="container">
      <h2>แก้ไขข้อมูล</h2>
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
          <button class="btn btn-primary" @click="updateUser()">
            อัพเดทข้อมูล
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      name: "",
      city: "",
    };
  },
  mounted() {
    axios.get("/api/user/" + this.id).then((res) => {
      this.name = res.data.name;
      this.city = res.data.city;
    });
  },
  methods: {
    updateUser() {
      axios.put("/api/user/" + this.id, {
        name: this.name,
        city: this.city,
      });
    },
  },
};
</script>

<style>
</style>