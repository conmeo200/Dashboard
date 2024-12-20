<template>
  <div>
    <div>
      <Menu v-if="isAuth"></Menu>

      <router-view />
    </div>
  </div>
</template>

<script>
import Login from "./components/Auth/Login.vue";
import Menu from "./components/Generate/Menu.vue";

export default {
  components: { Login, Menu },
  data() {
      return {
          isAuth: false
      };
  },
  methods: {
    checkAuthentication() {
      this.isAuth = document.cookie.includes('token_name');
    },
  }
};
</script>