<template>
    <div class="register container">

        <form @submit.prevent="registerUser">
            <h2>Register</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" v-model="name" required/>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" v-model="email" required/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" v-model="password" required/>
            </div>
            <button type="submit">Register</button>
            <p>
                Already have an account?
                <router-link to="/login">Login</router-link>
            </p>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data() {
            return {
                name: "",
                email: "",
                password: "",
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
</style>
