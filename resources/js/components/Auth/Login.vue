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

            <Button @click="handleSubmit">Sign In</Button>
        </form>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                autoLogin: true,
                formLogin: {
                    email   : '',
                    password: '',
                }
            }
        },

        methods: {
            async handleSubmit() {
                const rsp = await this.callApi('POST', 'api/login', this.formLogin, true);
                console.log(rsp); return;
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
