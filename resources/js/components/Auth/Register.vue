<template>
  <div class="register container">
    <h2>Register</h2>
    <form @submit.prevent="registerUser">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" v-model="name" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>
      <button type="submit">Register</button>
    </form>
    <p>
      Already have an account? <router-link to="/login">Login</router-link>
    </p>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      name     : "",
      email    : "",
      password : "",
    };
  },
  methods: {
    registerUser() {
      // Logic for register
      console.log("Register with", this.name, this.email, this.password);
    },
  },
};
</script>
