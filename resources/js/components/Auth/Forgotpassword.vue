<template>
    <div class="demo-login">
        <h1 style="text-align: center;margin-bottom: 20px;">Forgot Password</h1>
        <form>
            <Input type="email" v-model="fp_emaill" placeholder="Email">
                <template #prepend>
                  <Icon type="ios-person-outline"></Icon>
                </template>
            </Input>

            <br>

            <Input v-if="isForgotPassword" type="password" v-model="fp_password" placeholder="Password">
                <template #prepend>
                  <Icon type="ios-lock-outline"></Icon>
                </template>
            </Input>

            <br>

            <div style="text-align: center">
                <Button v-if="!isForgotPassword" @click="handleCheckEmail" type="success" style="margin-right: 10px;">Send</Button>
                <Button v-else @click="handleForgotPassword" type="success" style="margin-right: 10px;">Submit</Button>

                <router-link :to="{ name: 'Register'}">
                    <Button class="_btn _action_btn view_btn2" type="info">Sign Up</Button>
                </router-link>
                
                <br>                           
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                autoLogin       : true,
                isForgotPassword: false,
                fp_emaill       : '',
                fp_password     : ''
            }
        },

        methods: {
            async handleCheckEmail() {
                this.isForgotPassword = true;
                console.log('Check Email');
            },
            async handleForgotPassword() {
                console.log('Forgot Password');
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
