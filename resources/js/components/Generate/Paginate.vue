<template>
    <nav v-if="pagination">
        <ul class="pagination">
            <li :class="{'disabled': !pagination.prev_page_url}">
                <a href="#" @click.prevent="changePage(pagination.current_page - 1)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Tạo ra danh sách các trang -->
            <li v-for="page in pages" :key="page" :class="{'active': page === pagination.current_page}">
                <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
            </li>

            <li :class="{'disabled': !pagination.next_page_url}">
                <a href="#" @click.prevent="changePage(pagination.current_page + 1)" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: {
            pagination: {
                type: Object,
                required: true
            }
        },
        computed: {
            pages() {
                const pageArray = [];
                for (let i = 1; i <= this.pagination.last_page; i++) {
                    pageArray.push(i);
                }
                return pageArray;
            }
        },
        methods: {
            changePage(page) {
                if (page >= 1 && page <= this.pagination.last_page) {
                    this.$emit('page-changed', page);
                }
            }
        }
    }
</script>

<style scoped>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding-left: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a {
        padding: 8px 12px;
        color: #007bff;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }

    .pagination li.active a {
        background-color: #007bff;
        color: #fff;
    }

    .pagination li.disabled a {
        color: #ccc;
        cursor: not-allowed;
    }
</style>
