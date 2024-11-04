<template>
    <div v-if="message" class="alert" :class="{ 'alert-success': success, 'alert-danger': !success }">
        <!-- Hiển thị lỗi nếu có -->
        <div v-if="!success">
            <div v-for="(messages, field) in message" :key="field">
                <p v-for="(msg, index) in messages" :key="index">{{ msg }}</p>
            </div>
        </div>

        <!-- Hiển thị thông báo thành công -->
        <div v-else>
            <p>{{ message }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "AlertComponent",
    props: {
        success: {
            type: Boolean,
            required: true,
        },
        message: {
            type: [Object, String],
            required: true,
        },
    },
};
</script>

<style>
/* Style cho alert */
.alert {
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}
</style>
