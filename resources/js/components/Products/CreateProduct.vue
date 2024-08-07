<!-- src/components/MyForm.vue -->
<template>
    <div class="container mt-5">
        <form @submit.prevent="submitForm" class="border p-4 shadow-sm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" v-model="name" id="name" class="form-control" />
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" v-model="type" id="type" class="form-control" />
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input
                    type="text"
                    v-model="price"
                    @input="numberOnly($event, maxLength, leadingZero, allowDecimal)"
                    class="form-control"
                    id="price"
                />
            </div>

            <div class="form-group">
                <label for="images">Choose Images:</label>
                <input type="file" @change="handleFileChange" id="images" class="form-control-file" multiple />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <button @click="goBack" class="btn btn-danger">Back</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "CreateProduct",

        data() {
            return {
                name         : '',
                price        : 0,
                type         : '',
                images       : [],
                maxLength    : 10,
                leadingZero  : true,
                allowDecimal : false,
            };
        },
        methods: {
            numberOnly(event, maxLength, leadingZero = true, allowDecimal = false) {
                let value = event.target.value;

                if (allowDecimal) {
                    value = value.replace(/[^0-9.]/g, '');

                    let parts = value.split('.');
                    if (parts.length > 2) {
                        value = parts[0] + '.' + parts.slice(1).join('');
                    }
                } else {
                    value = value.replace(/[^0-9]/g, '');
                }

                if (!leadingZero) {
                    if (value.startsWith('0') && value.length > 1 && (allowDecimal ? value[1] !== '.' : true)) {
                        value = value.replace(/^0+/, '');
                    }
                }

                if (maxLength && value.length > maxLength) {
                    value = value.slice(0, maxLength);
                }

                this.price = value;
            },
            goBack() {
                this.$router.push('/products');
            },
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
<style scoped>
    .container {
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, 0.075) !important;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .align-items-center {
        align-items: center;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mt-5 {
        margin-top: 3rem;
    }
</style>
