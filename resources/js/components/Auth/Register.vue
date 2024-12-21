<template>
    <div class="demo-login">
        <h1 style="text-align: center;margin-bottom: 20px;">Register</h1>
        <form >
        
            <Input type="text" v-model="name" placeholder="Full Name">
                <template #prepend>
                  <Icon type="ios-person-outline"></Icon>
                </template>
            </Input>

            <br>

            <Input type="email" v-model="email" placeholder="Email">
                <template #prepend>
                  <Icon type="ios-person-outline"></Icon>
                </template>
            </Input>

            <br>

            <Input type="password" v-model="password" placeholder="Password">
                <template #prepend>
                  <Icon type="ios-lock-outline"></Icon>
                </template>
            </Input>

            <br>
            <div style="text-align:center">
                <Button @click="registerUser"  type="success" style="margin-right: 10px;">Register</Button>
                <p>
                    Already have an account?
                    <router-link to="/login">Login</router-link>
                </p>
            </div>
        </form>
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
                isSuccess: '',
                showAlert: false,
                messages : '',
            };
        },
        methods: {
            async registerUser() {

                console.log(123123123123);
                // let url        = this.url_api + '/register';
                // this.isLoading = true;

                // try {
                //     const response     = await axios.post(url, {email: this.email, name: this.name, password: this.password});
                //     const dataResponse = response.data;
                //     console.log('Response:', response.data);

                //     if (dataResponse.status_code == 200) {
                //         this.messages  = "Register User Successfully !";
                //         this.isSuccess =  true;
                //     } else {
                //         console.log(dataResponse);
                //         this.isSuccess  =  false;
                //     }

                //     this.name      = "";
                //     this.email     = "";
                //     this.password  = "";
                //     this.showAlert =  true
                // } catch (error) {
                //     console.error('Error:', error);
                // } finally {
                //     this.isLoading = false;
                // }
            },
        },
    };
</script>
<style>
    .demo-login{
        width: 400px;
        margin: 0 auto !important;
    }
    .demo-auto-login{
        margin-bottom: 24px;
        text-align: left;
    }
    .demo-auto-login a{
        float: right;
    }
</style>
