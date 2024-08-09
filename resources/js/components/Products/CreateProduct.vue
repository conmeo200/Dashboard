<template>
    <div class="container mt-5">
        <form @submit.prevent="submitForm" class="border p-4 shadow-sm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" v-model="name" id="name" class="form-control" />
                <span class="error">{{errors.name}}</span>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" v-model="type" id="type" class="form-control" />
                <span class="error">{{errors.type}}</span>
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
                <span class="error">{{errors.price}}</span>
            </div>

            <div class="form-group">
                <label for="images">Choose Images:</label>
                <input type="file" @change="handleFileChange" id="images" class="form-control-file" multiple />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <button @click="goBack" class="btn btn-danger">Back</button>
                <button type="submit" class="btn btn-primary">{{ isEditMode ? 'Update' : 'Submit' }}</button>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "MyForm",
        props: {
            product: {
                type: Object,
                default: () => ({ id: -1, name: '', price: 0, type: '', images: [] })
            },
            isEditMode: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                name: '',
                price: 0,
                type: '',
                images: [],
                maxLength: 10,
                leadingZero: true,
                allowDecimal: false,
                errors: {
                    name: '',
                    price: '',
                    type: '',
                    images: ''
                }
            };
        },
        watch: {
            product: {
                handler(newValue) {
                    if (this.isEditMode) {
                        this.name = newValue.name;
                        this.price = newValue.price;
                        this.type = newValue.type;
                        this.images = newValue.images;
                    }
                },
                deep: true
            }
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
                this.images = Array.from(event.target.files); // Cập nhật hình ảnh
            },
            async submitForm() {
                const formData = new FormData();

                // Kiểm tra lỗi và thêm vào `formData`
                if (!this.name) {
                    this.errors.name = 'This field is required';
                }
                if (!this.type) {
                    this.errors.type = 'This field is required';
                }
                if (!this.price) {
                    this.errors.price = 'This field is required';
                }

                this.images.forEach((file, index) => {
                    formData.append(`images[${index}]`, file); // Sửa `files` thành `images`
                });

                formData.append('name', this.name);
                formData.append('type', this.type);
                formData.append('price', this.price);

                try {
                    const response = await axios.post('http://dashboard.test/api/product', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },
                    });
                    console.log('Response:', response.data);
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        }
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

    .error {
        color: red;
    }
</style>
