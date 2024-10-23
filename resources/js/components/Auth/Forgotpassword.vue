<template>
  <div class="forgot-password container">
    <h2>Forgot Password</h2>
    <form @submit.prevent="resetPassword">
      <div class="form-group">
        <label for="email">Enter your email:</label>
        <input type="email" v-model="email" required />
      </div>
      <button type="submit">Reset Password</button>
    </form>
    <p>
      Remembered your password? <router-link to="/login">Login</router-link>
    </p>
  </div>
</template>

<script>
export default {
  name: "Forgotpassword",
  data() {
    return {
      email: "",
    };
  },
  methods: {
    resetPassword() {
      // Logic for resetting password
      console.log("Password reset email sent to", this.email);
    },
  },
};
</script>
<style scoped>
.forgot-password {
  text-align: center;
}

h2 {
  margin-bottom: 20px;
}

.router-link {
  color: #007bff;
}
</style>