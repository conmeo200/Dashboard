<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Role List</h1>
            <router-link to="/create-product" class="btn btn-dark">Add Product</router-link>
        </div>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody v-for="role in roles" :key="role.id">
            <tr>
                <td>#{{role.id}}</td>
                <td>{{role.name}}</td>
                <td>{{role.created_at}}</td>
                <td>{{role.updated_at}}</td>
                <td>
                    <button class="btn btn-primary" style="margin-right: 10px;">View</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Truyền dữ liệu pagination từ API vào component Pagination -->
        <Pagination :pagination="paginationData" @page-changed="fetchRoles" />
    </div>
</template>

<script>
    import axios from 'axios';
    import Pagination from '../Generate/Paginate.vue';

    export default {
        components: {
            Pagination
        },
        data() {
            return {
                roles: [],
                paginationData: null // Dữ liệu pagination từ API
            };
        },
        methods: {
            async fetchRoles(page = 1) {
                try {
                    const response      = await axios.get(`http://dashboard.test/api/roles?page=${page}`);
                    this.roles          = response.data.data; // Dữ liệu danh sách các roles
                    this.paginationData = response.data.pagination; // Dữ liệu phân trang
                } catch (error) {
                    console.error('Error fetching roles:', error);
                }
            }
        },
        mounted() {
            this.fetchRoles();
        }
    }
</script>
