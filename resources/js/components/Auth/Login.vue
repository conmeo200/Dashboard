<template>
  <div class="login container">
    
    <form @submit.prevent="loginUser">
      <h2>Login</h2>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Login</button>
       <p>
      Don't have an account? <router-link to="/register">Register</router-link>
    </p>
    <p>
      Forgot your password? <router-link to="/forgot-password">Reset Password</router-link>
    </p>
    </form>
   
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
.container {
  font-family: 'Roboto', sans-serif;
  background-color: #f0f4f8;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  background-color: #fff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

/* Các class khác từ CSS cũ vẫn giữ nguyên */
</style>
