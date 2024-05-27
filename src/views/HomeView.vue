<template>
  <div>
    <h1>Xin chào, {{ currentUser ? currentUser.taikhoan : "Khách hàng" }}!</h1>
    <button @click="handleLogout">Đăng xuất</button>
  </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
  setup() {
    const currentUser = JSON.parse(localStorage.getItem("currentUser"));
    const logoutStatus = ref(null);
    const router = useRouter();

    const handleLogout = async () => {
      try {
        const response = await axios.get(
          "http://localhost/LVTN/book-store/src/api/logout.php"
        );
        if (response) {
          localStorage.removeItem("currentUser");
          logoutStatus.value = true;
          // Chuyển hướng đến trang đăng nhập hoặc trang chính của ứng dụng
          router.push("/login");
        } else {
          logoutStatus.value = false;
          alert("Đã xảy ra lỗi khi đăng xuất");
        }
      } catch (error) {
        console.error("Lỗi:", error);
        logoutStatus.value = false;
        alert("Đã xảy ra lỗi khi đăng xuất");
      }
    };

    return { currentUser, handleLogout, logoutStatus };
  },
};
</script>
