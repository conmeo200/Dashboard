<template>
  <div>
    <div>
      <Menu v-if="authState.isAuth"></Menu>

      <router-view />
    </div>
  </div>
</template>

<script>
import Menu from "./components/Generate/Menu.vue";
import { authState } from './components/Auth/authState';

export default {
  components: { Menu },
  setup() {
    return {
      authState,
    };
  },
};
</script>