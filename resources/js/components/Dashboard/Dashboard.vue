<template>
    <div>
        <h1>Dashboard</h1>
        <button @click="changeParentText">Click</button>
        <Button :title="title" @handleChange="changeText"/>
    </div>
</template>

<script>
    import Button from '../Generate/Button'; // Đường dẫn đến component Button

    export default {
        name: "Dashboard",
        components: {
            Button
        },
        data() {
            return {
                title: 'Data Parent'
            }
        },
        methods: {
            changeText(data) {
                this.title = data.title; // Cập nhật title từ dữ liệu emit từ ButtonComponent
            },
            changeParentText() {
                this.title = 'Data Parent';
            }
        }
    }
</script>

<style scoped>
</style>
