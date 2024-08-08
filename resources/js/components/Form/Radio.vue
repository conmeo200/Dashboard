<!-- src/components/MyForm.vue -->
<template>
    <div>
        <form @submit.prevent="submitForm">
            <div>
                <label for="username">Username:</label>
                <input type="text" v-model="username" id="username" />
            </div>

            <div>
                <label for="files">Choose files:</label>
                <input type="file" @change="handleFileChange" id="files" multiple />
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                username: '',
                files: [],
            };
        },
        methods: {
            handleFileChange(event) {
                this.files = Array.from(event.target.files);
            },
            async submitForm() {
                const formData = new FormData();
                formData.append('username', this.username);

                // Thêm tất cả các tệp tin vào FormData
                this.files.forEach((file, index) => {
                    formData.append(`files[${index}]`, file);
                });

                try {
                    const response = await axios.post('http://dashboard.test/api/lead-form', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },
                    });
                    console.log('Response:', response.data);
                } catch (error) {
                    console.error('Error:', error);
                }
            },
        },
    };
</script>
