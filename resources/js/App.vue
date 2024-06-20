<template>
    <div>
        <Menu @navigate="navigate"/>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <Navbar :page="page" :breadcrumb="breadcrumb" />
            <div>
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
    import Menu from './components/Menu/Menu';
    import Navbar from './components/Navbar/Navbar';

    export default {
        name: 'App',
        components: {
            Navbar,
            Menu
        },
        data() {
            return {
                page: '',
                breadcrumb: ''
            };
        },
        watch: {
            '$route' (to) {
                this.page       = to.meta.page;
                this.breadcrumb = to.meta.breadcrumb;
            }
        },
        methods: {
            navigate(routeName) {
                this.$router.push({ name: routeName });
            }
        }
    }
</script>
