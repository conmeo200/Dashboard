<template>
    <div class="forgot-password container">

        <form @submit.prevent="resetPassword">
            <h2>Forgot Password</h2>
            <div class="form-group">
                <label for="email">Enter your email:</label>
                <input type="email" v-model="email" required/>
            </div>
            <button type="submit">Reset Password</button>
            <p>
                Remembered your password?
                <router-link to="/login">Login</router-link>
            </p>
        </form>

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
