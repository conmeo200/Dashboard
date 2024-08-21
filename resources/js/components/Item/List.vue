<template>
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">List Items</h1>
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
            <tbody class="test">
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import Modal from '../Modal/Modal.vue';
    import CreateProduct from './CreateProduct.vue';

    export default {
        name: "Item",
        components: {
            Modal,
            CreateProduct
        },
        data() {
            return {

            };
        },
        mounted() {
            this.fetchProducts();
        },
        methods: {
            async fetchProducts() {
                // let url = 'http://Dashboard.test/api/products';
                // try {
                //     await axios
                //         .get(url)
                //         .then(response => {
                //             var list   = response.data;

                //             if (list.data.length ) {
                //                 this.products = list.data;
                //             }

                //         }).catch(error => {
                //             this.errors = error.response.data.message;
                //         });
                // } catch (e) {
                //     this.errors = e.response.data.message;
                // }
            },
            handleDelete(id) {
                // let url = 'http://Dashboard.test/api/delete/';
                // try {
                //     axios
                //         .delete(url + id)
                //         .then(response => {
                //             var list   = response.data;
                //             if (list.data.length ) {
                //                 this.products = list.data;
                //             }
                //         }).catch(error => {
                //         this.errors = error.response.data.message;
                //     });
                // } catch (e) {
                //     this.errors = e.response.data.message;
                // }
            },
            View(id) {
                // let url = 'http://Dashboard.test/api/product/';
                // this.showModal      = true;
                // try {
                //     axios
                //         .get(url + id)
                //         .then(response => {
                //             var list   = response.data;

                //             if (list.data) {
                //                 const data          = list.data;

                //                 this.modelProduct.id     = data.id;
                //                 this.modelProduct.name   = data.name;
                //                 this.modelProduct.price  = data.price;
                //                 this.modelProduct.images = data.images;
                //                 this.modelProduct.type   = data.type_product_id;
                //                 this.content_modal       = `Information`;
                //                 this.title_modal         = `Product # ${data.id}`;
                //             }
                //         }).catch(error => {this.errors = error.response.data.message;});
                // } catch (e) {
                //     this.errors = e.response.data.message;
                // }
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
