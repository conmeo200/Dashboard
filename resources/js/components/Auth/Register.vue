<template>
    <div class="register container">

        <form @submit.prevent="registerUser">
            <h2>Register</h2>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" v-model="name"/>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" v-model="email"/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" v-model="password"/>
            </div>
            <button type="submit">Register</button>
            <p>
                Already have an account?
                <router-link to="/login">Login</router-link>
            </p>
        </form>

        <AlertComponent v-if="showAlert" :success="isSuccess" :message="messages" />
    </div>
</template>

<script>
    import AlertComponent from '../Generate/Alert.vue';

    export default {
        name: "Register",
        components : {AlertComponent},
        data() {
            return {
                name     : "",
                email    : "",
                password : "",
                url_api  : process.env.VUE_APP_API_URL,
                isLoading: false,
                errors   : [],
                success  : null,
                isSuccess : '',
                showAlert : false,
                messages : ''
            };
        },
        methods: {
            async registerUser() {
                let url        = this.url_api + '/register';
                this.isLoading = true;

                try {
                    const response     = await axios.post(url, {email: this.email, name: this.name, password: this.password});
                    const dataResponse = response.data;
                    console.log('Response:', response.data);

                    if (dataResponse.status_code == 200) {
                        this.messages  = "Register User Successfully !";
                        this.isSuccess =  true;
                    } else {
                        console.log(dataResponse);
                        this.isSuccess  =  false;
                    }

                    this.name      = "";
                    this.email     = "";
                    this.password  = "";
                    this.showAlert =  true
                } catch (error) {
                    console.error('Error:', error);
                } finally {
                    this.isLoading = false;
                }
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
