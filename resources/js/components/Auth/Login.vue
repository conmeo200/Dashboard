<template>
  <div class="login container">
    <h2>Login</h2>
    <form @submit.prevent="loginUser">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
    </form>
    <p>
      Don't have an account? <router-link to="/register">Register</router-link>
    </p>
    <p>
      Forgot your password? <router-link to="/forgot-password">Reset Password</router-link>
    </p>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email    : "",
      password : "",
    };
  },
  methods: {
    loginUser() {
      // Logic for login
      console.log("Login with", this.email, this.password);
    },
  },
};
</script>
<style scoped>
.login {
  text-align: center;
}

h2 {
  margin-bottom: 20px;
}

.router-link {
  color: #007bff;
}
</style>
