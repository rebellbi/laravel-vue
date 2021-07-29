<template>
  <div>
    <div class="container">
      <h2 class="text-center">แสดงข้อมูล</h2>
      <table class="table table-bordered">
        <tr>
          <th>รหัส</th>
          <th>ชื่อ</th>
          <th>เมือง</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
        <tr v-for="(user, index) in users" :key="index">
          <td>
            {{ user.id }}
          </td>
          <td>
            {{ user.name }}
          </td>
          <td>
            {{ user.city }}
          </td>
          <td>
            <a :href="'/user/' + user.id + '/edit'" class="btn btn-primary"
              >Edit</a
            >
          </td>
          <td>
            <a
              href="javascript:;"
              class="btn btn-danger"
              @click="deleteUser(user.id, index)"
              >Delete</a
            >
          </td>
        </tr>
      </table>
      <a href="/user/create" class="btn btn-primary">เพิ่มข้อมูล</a>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
  data() {
    return {
      users: [],
      user: {
        id: 0,
        name: "",
        city: "",
      },
    };
  },
  mounted() {
    this.getUserData();
  },
  methods: {
    getUserData() {
      axios.get("api/user").then((res) => {
        this.users = res.data;
      });
    },
    deleteUser(id, index) {
      axios.delete("api/user/" + id).then((res) => {
        this.users.splice(index, 1);
      });
    },
  },
};
</script>

<style>
</style>