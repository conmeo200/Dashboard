<template>
    <div id="app">
        <Menu />
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <Navbar />
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    import Menu from './components/Menu/Menu';
    import Navbar from './components/Navbar/Navbar';

    export default {
        name: 'App',
        components : {
            Menu,
            Navbar
        }
    }
</script>
