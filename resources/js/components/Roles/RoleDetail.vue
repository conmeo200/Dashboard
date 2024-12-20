<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
        <div
          class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20"
        >
          <p class="_title0">
            Role Manangement
            <Select
              v-model="data.id"
              placeholder="Select admin type"
              style="width: 300px"
            >
              <!-- Kiểm tra nếu roles rỗng -->
              <Option v-if="!roles.length" disabled :value="0">Empty Role</Option>

              <!-- Lặp qua roles để render các Option -->
              <Option :value="r.id" v-for="r in roles" :key="r.id">
                {{ r.name }}
              </Option>
            </Select>
          </p>

          <div class="_overflow _table_div">
            <table class="_table">
              <!-- TABLE TITLE -->
              <tr>
                <th>Resource name</th>
                <th>Read</th>
                <th>Write</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
              <!-- TABLE TITLE -->

              <!-- ITEMS -->
              <tr v-for="(r, i) in resources" :key="i">
                <td>{{ r.resourceName }}</td>
                <td><Checkbox v-model="r.read"></Checkbox></td>
                <td><Checkbox v-model="r.write"></Checkbox></td>
                <td><Checkbox v-model="r.update"></Checkbox></td>
                <td><Checkbox v-model="r.delete"></Checkbox></td>
              </tr>
              <!-- ITEMS -->
              <div class="center_button">
                <Button
                  type="primary"
                  :loading="isSending"
                  :disabled="isSending"
                  >Assign</Button
                >
              </div>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      data: {
        id: 1,
      },
      isSending: false,
      roles: [],
      resources: [
        {
          resourceName: "Home",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "/",
        },
        {
          resourceName: "Tags",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "tags",
        },
        {
          resourceName: "Category",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "category",
        },
        {
          resourceName: "Create blogs",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "createBlog",
        },
        {
          resourceName: "Blogs",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "blogs",
        },
        {
          resourceName: "Admin users",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "adminusers",
        },
        {
          resourceName: "Role",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "role",
        },
        {
          resourceName: "Assign Role",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "assignRole",
        },
      ],
      defaultResourcesPermission: [
        {
          resourceName: "Home",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "/",
        },
        {
          resourceName: "Tags",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "tags",
        },
        {
          resourceName: "Category",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "category",
        },
        {
          resourceName: "Create blogs",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "createBlog",
        },
        {
          resourceName: "Blogs",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "blogs",
        },

        {
          resourceName: "Admin users",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "adminusers",
        },
        {
          resourceName: "Role",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "role",
        },
        {
          resourceName: "Assign Role",
          read: false,
          write: false,
          update: false,
          delete: false,
          name: "assignRole",
        },
      ],
    };
  },
  mounted() {
    this.getAllRoles();
  },
  methods: {
    async getAllRoles() {
      try {
        const rsp = await this.callApi("get", `api/role`);
        if (rsp.success) {
          this.roles = rsp.data || [];
        } else {
          this.roles = [];
        }
      } catch (error) {
        this.error("Unable to fetch roles. Please check the server.");
      }
    },
  },
};
</script>