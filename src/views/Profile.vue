<template>
  <div class="container">
    <div
      class="cover-image"
      :style="{ backgroundImage: `url(${userData.anhbia})` }"
    >
      <!-- <input type="file" @change="handleCoverImageUpload" /> -->
    </div>
    <div class="profile">
      <div class="profile-content">
        <div class="left-side">
          <div class="ass">
            <h4>Tài khoản của tôi</h4>
            <button @click="updateProfile">Cập nhật</button>
          </div>

          <form @submit.prevent="updateProfile">
            <h3>Thông tin tài khoản</h3>
            <div class="user-info">
              <div class="info">
                <p>Tên đăng nhập</p>
                <input
                  type="text"
                  name=""
                  id=""
                  :placeholder="userData.taikhoan"
                  disabled
                />
              </div>
              <div class="info">
                <p>Địa chỉ email</p>
                <input type="text" name="" id="" v-model="userData.email" />
              </div>
              <div class="info">
                <p>Họ và tên</p>
                <input type="text" name="" id="" v-model="userData.tenKH" />
              </div>
              <div class="info">
                <p>Số điện thoại</p>
                <input type="text" name="" id="" v-model="userData.sdt" />
              </div>
            </div>
            <div class="user-contact">
              <h3 class="add">Địa chỉ liên hệ</h3>
              <div class="address">
                <p>Địa chỉ của tôi</p>
                <input type="text" name="" id="" v-model="userData.diachi" />
              </div>
              <div class="address">
                <button class="btn">
                  <router-link to="/changepass"> Đổi mật khẩu </router-link>
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="right-side">
          <div
            class="avatar"
            :style="{ backgroundImage: `url(${userData.hinh})` }"
          >
            <!-- <input type="file" @change="handleAvatarUpload" /> -->
          </div>
          <div class="descrip">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias
            excepturi laudantium natus distinctio similique sunt totam. Quas,
            similique iste totam quam molestias labore saepe sed deserunt
            delectus fugit? Culpa, deleniti?
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
  setup() {
    const currentUser = JSON.parse(localStorage.getItem("currentUser"));
    const userData = ref({ ...currentUser });

    const updateProfile = () => {
      axios
        .post(
          "http://localhost/LVTN/book-store/src/api/updateProfile.php",
          userData.value
        )
        .then((res) => {
          if (res.data) {
            localStorage.setItem("currentUser", JSON.stringify(userData.value));
            alert("Cập nhật thông tin thành công");
            window.location.reload();
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    const handleCoverImageUpload = (event) => {
      const file = event.target.files[0];
      const formData = new FormData();
      formData.append("anhbia", file);
      axios
        .post(
          "http://localhost/LVTN/book-store/src/api/uploadCoverImage.php",
          formData
        )
        .then((response) => {
          userData.value.anhbia = response.data.url; // Assuming your backend returns the URL of the uploaded image
        })
        .catch((error) => {
          console.error("Error uploading cover image:", error);
        });
    };

    const handleAvatarUpload = (event) => {
      const file = event.target.files[0];
      const formData = new FormData();
      formData.append("hinh", file);
      axios
        .post(
          "http://localhost/LVTN/book-store/src/api/uploadAvatar.php",
          formData
        )
        .then((response) => {
          userData.value.hinh = response.data.url; // Assuming your backend returns the URL of the uploaded image
        })
        .catch((error) => {
          console.error("Error uploading avatar:", error);
        });
    };
    return {
      currentUser,
      userData,
      updateProfile,
      handleCoverImageUpload,
      handleAvatarUpload,
    };
  },
};
</script>
<style lang="scss" scoped>
@import "@/assets/styles/profile.scss";
</style>
