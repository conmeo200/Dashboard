<template>
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Product List</h1>
            <router-link to="/create-product" class="btn btn-dark">Add Product</router-link>
        </div>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Products",

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
<style scoped>
    .container {
        max-width: 800px;
    }

    .table {
        margin-top: 20px;
    }

    thead.thead-dark th {
        background-color: #343a40;
        color: #fff;
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
