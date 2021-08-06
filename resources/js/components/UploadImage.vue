<template>
  <div class="container">
    <div class="mt-10">
      <img :src="image" alt="" />
      <input type="file" @change="handleImage" accept="image/*" />
    </div>
    <div class="mt-10">
      <h3>Server Image</h3>
      <img :src="remoteUrl" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      image: "",
      remoteUrl: "",
    };
  },
  methods: {
    handleImage(e) {
      const selectedImage = e.target.files[0];
      this.creatBase64Image(selectedImage);
    },
    creatBase64Image(fileObject) {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.image = e.target.result;
        this.uploadImage();
      };
      reader.readAsDataURL(fileObject);
    },
    uploadImage() {
      const { image } = this;
      axios
        .post("api/upload", { image })
        .then((res) => {
          this.remoteUrl = res.data.url;
        })
        .catch((err) => {
          console.log(err.message);
        });
    },
  },
};
</script>

<style>
</style>