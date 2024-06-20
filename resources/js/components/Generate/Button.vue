<template>
    <div>
        <h1>{{ title }}</h1>
        <button @click="handleChange">Change Again</button>
    </div>
</template>

<script>
    export default {
        name: "Button",
        props: {
            title: String  // Định nghĩa prop 'title' với kiểu là String
        },
        emits: ['handleChange'], // Khai báo sự kiện 'handleChange'
        methods: {
            handleChange() {
                var data = {
                    'title': 'Data Child'
                };

                this.$emit('handleChange', data); // Phát ra sự kiện 'handleChange' với dữ liệu 'data'
            }
        }
    }
</script>

<style scoped>
    /* CSS styles for ButtonComponent */
</style>
