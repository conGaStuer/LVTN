<template>
  <div>
    <input
      type="email"
      v-model="email"
      placeholder="Nhập địa chỉ email của bạn"
    />
    <button @click="resetPassword">Gửi Email</button>
    <p v-if="message">{{ message }}</p>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      email: "",
      message: "",
    };
  },
  methods: {
    resetPassword() {
      // Gửi yêu cầu đặt lại mật khẩu với email đến máy chủ
      // Sử dụng axios hoặc fetch để thực hiện yêu cầu HTTP POST
      axios
        .post("http://localhost/LVTN/book-store/src/api/changepass.php", {
          email: this.email,
        })
        .then((response) => {
          // Hiển thị thông báo từ phản hồi của máy chủ
          this.message = response.data.message;
        })
        .catch((error) => {
          console.error("Error:", error);
          this.message = "Đã xảy ra lỗi.";
        });
    },
  },
};
</script>
