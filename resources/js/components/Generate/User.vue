<template>
    <div class="user">
        <h3>{{user.name}}</h3>
        <button v-on:click="handleDelete">Delete ID</button>
    </div>
</template>

<script>
    export default {
        name: "User",
        props: {
            user: {
                type: Object,
            }
        },
        methods : {
            handleDelete() {
                this.$emit('handleDelete', this.user.id);
            }
        }
    }
</script>

<style scoped>

</style>
