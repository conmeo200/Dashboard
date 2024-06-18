<template>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
                <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item" v-if="listMenu.length" v-for="(menu, index) in listMenu">
                    <router-link class="nav-link text-white " href="d.html" :to="menu.keyword">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">{{menu.icon}}</i>
                        </div>
                        <span class="nav-link-text ms-1">{{menu.name}}</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Menu",
        data: function () {
            return {
                listMenu : {}
            }
        },
        created() {
            this.getListMenu();
        },
        methods: {
            async getListMenu() {
                let url = 'http://Dashboard.test/api/list-menu';
                try {
                    await axios
                        .get(url)
                        .then(response => {
                            var list   = response.data;

                            if (list.data.length ) {
                                this.listMenu = list.data;
                            }

                        }).catch(error => {
                            this.errors = error.response.data.message;
                        });
                } catch (e) {
                    this.errors = e.response.data.message;
                }
            },
        }
    }
</script>

<style scoped>

</style>
