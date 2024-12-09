<template>
    <nav v-if="pagination">
        <ul class="pagination">
            <!-- Nút quay lại -->
            <li :class="{'disabled': !pagination.prev_page_url}">
                <a href="#" @click.prevent="changePage(pagination.current_page - 1)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Nút đầu tiên -->
            <li :class="{'active': 1 === pagination.current_page}">
                <a href="#" @click.prevent="changePage(1)">1</a>
            </li>

            <!-- Hiển thị dấu "..." nếu cần -->
            <li v-if="pagination.current_page > range + 2">
                <span>...</span>
            </li>

            <!-- Hiển thị các trang xung quanh trang hiện tại -->
            <li v-for="page in paginatedPages" :key="page" :class="{'active': page === pagination.current_page}">
                <a href="#" @click.prevent="changePage(page)">{{ page }}</a>
            </li>

            <!-- Hiển thị dấu "..." nếu cần -->
            <li v-if="pagination.current_page < pagination.last_page - range - 1">
                <span>...</span>
            </li>

            <!-- Nút cuối cùng -->
            <li 
                v-if="pagination.last_page != 1"
                :class="{'active': pagination.last_page === pagination.current_page}">
                <a href="#" @click.prevent="changePage(pagination.last_page)">{{ pagination.last_page }}</a>
            </li>

            <!-- Nút tới -->
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
            // Số trang muốn hiển thị xung quanh trang hiện tại
            range() {
                return 2; // Hiển thị 2 trang trước và sau trang hiện tại
            },
            paginatedPages() {
                const pages = [];
                const start = Math.max(this.pagination.current_page - this.range, 2); // Bắt đầu từ trang 2 trở đi
                const end   = Math.min(this.pagination.current_page + this.range, this.pagination.last_page - 1); // Dừng trước trang cuối

                for (let i = start; i <= end; i++) {
                    pages.push(i);
                }

                return pages;
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

    .pagination li span {
        padding: 8px 12px;
        color: #555;
    }
</style>
