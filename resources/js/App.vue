<template>
    <div>
      <div v-if="isAuth">
      <!--========== ADMIN SIDE MENU one ========-->
      <div class="_1side_menu" >
        <div class="_1side_menu_logo">
          <h3 style="text-align:center;">Logo Image</h3>
          <!--<img src="/img/logo.jpg" style="width: 108px;margin-left: 68px;"/>-->
        </div>

        <!--~~~~~~~~ MENU CONTENT ~~~~~~~~-->
        <div class="_1side_menu_content">
          <div class="_1side_menu_img_name">
            <!-- <img class="_1side_menu_img" src="/pic.png" alt="" title=""> -->
            <p class="_1side_menu_name">Admin</p>
          </div>

          <!--~~~ MENU LIST ~~~~~~-->
          <div class="_1side_menu_list">
            <ul class="_1side_menu_list_ul">
              <li><router-link to="/"><Icon type="md-home" /> Dashboard</router-link></li>
              <li @click="toggleDropdown" class="menu-item">
                <router-link to="#"><Icon type="md-settings" /> Setting</router-link>
                <ul v-if="isDropdownOpen" class="submenu" style="margin-left: 25px; list-style-type : none;">
                  <li>
                    <router-link to="/permissions"><Icon type="md-settings" />Permissons</router-link>
                  </li>
                  <li>
                    <router-link to="/roles"><Icon type="md-settings"/>Roles</router-link>
                  </li>
                </ul>
              </li>
              <li><router-link to="tags"><Icon type="md-pricetags" /> Tags</router-link></li>
              <li><router-link to="blogs"><Icon type="ios-book" /> Blogs</router-link></li>
              <li><router-link to="users"><Icon type="md-people" /> Users</router-link></li>
              <li><router-link to="products"><Icon type="md-shirt" />Products</router-link></li>
              <li><router-link to="orders"><Icon type="ios-list-box-outline" />Orders</router-link></li>
            
            </ul>
          </div>
        </div>
      </div>
      <!--========== ADMIN SIDE MENU ========-->

      <!--========= HEADER ==========-->
      <div class="header">
        <div class="_2menu _box_shadow">
          <div class="_2menu_logo">
            <ul class="open_button">
              <li>
                <Icon type="ios-list" />
              </li>
              <li>
                <Dropdown style="margin-left: 20px">                
                  <Icon type="md-contact" />
                  <template #list>
                      <DropdownMenu>
                          <DropdownItem>Profile</DropdownItem>                      
                          <DropdownItem>LogOut</DropdownItem>                      
                      </DropdownMenu>
                  </template>
                </Dropdown>
              </li>
              <li>
                <Icon type="md-notifications" />
              </li>
              <!--<li><Icon type="ios-albums" /></li>-->
            </ul>
          </div>
        </div>
      </div>
      <!--========= HEADER ==========-->

      <router-view />
      </div>
    </div>
</template>

<script>
import Login from './components/Auth/Login.vue'

export default {
    components : {Login},
    data() {
      return {
          isAuth : true,
          isDropdownOpen: false, // Trạng thái dropdown
      }
  },
    methods: {
      toggleDropdown() {
        this.isDropdownOpen = !this.isDropdownOpen;
      },
    },
}
</script>