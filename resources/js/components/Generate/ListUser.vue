<template>
    <div class="container">
        <User
            v-for="user in listUser"
            v-bind:key="user.id"
            v-bind:user="user"
            v-on:handleDelete="handDelete"
        />
    </div>
</template>

<script>
    import User from "../Generate/User";

    export default {
        name: "listUser",
        components: {
            User
        },
        props: {
            listUser: Array
        },
        methods: {
            handDelete(data) {
                console.log('Get id from component user : ' + data);
                this.$emit('handDelete', data);
            }
        }
    }
</script>

<style scoped>

</style>
