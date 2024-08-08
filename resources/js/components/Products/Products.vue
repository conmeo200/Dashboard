<template>
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Product List</h1>
            <router-link to="/create-product" class="btn btn-dark">Add Product</router-link>
        </div>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody v-for="(product, index) in products" :key="index" class="test">
            <tr>
                <td>#{{product.id}}</td>
                <td>{{product.name}}</td>
                <td>{{product.type_product_id}}</td>
                <td>{{product.price}}</td>
                <td>
                    <button class="btn btn-primary" @click="View(product.id)" style="margin-right: 10px;">View</button>
<button class="btn btn-danger" @click="handleDelete(product.id)">Delete</button>
                </td>
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
                products: [],
            };
        },
        mounted() {
            this.fetchProducts();
        },
        methods: {
            async fetchProducts() {
                let url = 'http://Dashboard.test/api/products';
                try {
                    await axios
                        .get(url)
                        .then(response => {
                            var list   = response.data;

                            if (list.data.length ) {
                                this.products = list.data;
                            }

                        }).catch(error => {
                            this.errors = error.response.data.message;
                        });
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            },
            handleDelete(id) {
                let url = 'http://Dashboard.test/api/delete/';
                try {
                    axios
                        .delete(url + id)
                        .then(response => {
                            var list   = response.data;
                            if (list.data.length ) {
                                this.users = list.data;
                            }
                        }).catch(error => {
                        this.errors = error.response.data.message;
                    });
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            },
            View(id) {
                let url = 'http://Dashboard.test/api/product/';
                try {
                    axios
                        .get(url + id)
                        .then(response => {
                            var list   = response.data;
                            if (list.data.length ) {
                                this.users = list.data;
                            }
                        }).catch(error => {
                        this.errors = error.response.data.message;
                    });
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            }
        }
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
