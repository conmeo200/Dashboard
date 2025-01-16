<template>
    <div class="demo-login">
        <h1 style="text-align: center;margin-bottom: 20px;">Login</h1>
        <form>
            <Input type="email" v-model="formLogin.email" placeholder="Email">
                <template #prepend>
                  <Icon type="ios-person-outline"></Icon>
                </template>
            </Input>

            <br>

            <Input type="password" v-model="formLogin.password" placeholder="Password">
                <template #prepend>
                  <Icon type="ios-lock-outline"></Icon>
                </template>
            </Input>

            <br>

            <div style="text-align: center">
                <Button @click="handleSubmit" type="success" style="margin-right: 10px;">Sign In</Button>

                <router-link :to="{ name: 'Register'}">
                    <Button class="_btn _action_btn view_btn2" type="info">Sign Up</Button>
                </router-link>
                
                <br>
                <router-link :to="{name : 'Forgotpassword'}"> ForgotPassword </router-link>                
            </div>
        </form>
    </div>
</template>
<script>
import { authState } from './authState';

    export default {
        data () {
            return {
                autoLogin: true,
                formLogin: {
                    email   : 'test1@gmail.com',
                    password: '123123',
                }
            }
        },

        methods: {
            async handleSubmit() {
                const rsp = await this.callApi('POST', 'api/login', this.formLogin);
                if (rsp && rsp.success == true) {
                    localStorage.setItem('isAuth', 'true');
                    authState.isAuth = true;
                    this.$router.push('/');
                } else {
                    this.error(rsp.messages);
                }
            }
        }
    }
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
