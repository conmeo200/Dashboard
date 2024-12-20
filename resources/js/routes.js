import {createRouter, createWebHistory} from "vue-router";

// component auth
import Login from "./components/Auth/Login.vue";
import Register from "./components/Auth/Register.vue";
import Forgotpassword from "./components/Auth/Forgotpassword.vue";

// component pages
import home from "./components/Page/home";
import tags from "./components/Page/tags";
import blogs from "./components/Page/blogs";
import blog_detail from "./components/Page/blogDetail";

// component users
import Users      from "./components/User/Users.vue";
import UserDetail from "./components/User/UserDetail.vue";
import CreateUser from "./components/User/CreateUser.vue";

// component products
import Products      from "./components/Products/Products.vue";
import ProductDetail from "./components/Products/ProductDetail.vue";
import CreateProduct from "./components/Products/CreateProduct.vue";

// component orders
import Orders      from "./components/Orders/Orders.vue";
import OrderDetail from "./components/Orders/OrderDetail.vue";
import CreateOrder from "./components/Orders/CreateOrder.vue";


// component roles
import Roles      from "./components/Roles/Roles.vue";
import RoleDetail from "./components/Roles/RoleDetail.vue";
import CreateRole from "./components/Roles/CreateRole.vue";

// component permissions
import Permissions      from "./components/Permissions/Permissions.vue";
import PermissionDetail from "./components/Permissions/PermissionDetail.vue";
import CreatePermission from "./components/Permissions/CreatePermission.vue";

const routes = [
    // Route Auth
    {
        name: 'Login',
        path: '/login',
        component: Login,
    },
    {
        name: 'Register',
        path: '/register',
        component: Register,
    },
    {
        name: 'Forgotpassword',
        path: '/forgot-password',
        component: Forgotpassword,
    },

    // End Route Auth
    
    // Route Home
    {
        name: 'home',
        path: '/',
        component: home
    },
    // End Route Home

    // Route Permissions
    {
        name: 'permissions',
        path: '/permissions',
        component: Permissions
    },
    {
        name: 'create-permission',
        path: '/create-permission',
        component: CreatePermission
    },
    {
        name: 'permission-detail',
        path: '/permission/:id/detail',
        component: PermissionDetail
    },
    // End Route Permissions

    // Route Roles
    {
        name: 'roles',
        path: '/roles',
        component: Roles
    },
    {
        name: 'create-role',
        path: '/create-role',
        component: CreateRole
    },
    {
        name: 'role-detail',
        path: '/role/:id/detail',
        component: RoleDetail
    },
    // End Route Roles

    // Route Tag
    {
        name: 'tags',
        path: '/tags',
        component: tags
    },
    // End Route Tag

    // Route Blog
    {
        name: 'blogs',
        path: '/blogs',
        component: blogs
    },
    {
        name: 'blog_detail',
        path: '/blog/:id/detail',
        component: blog_detail
    },
    // End Route Blog

    // Route User
    {
        name: 'users',
        path: '/users',
        component: Users
    },
    {
        name: 'create-user',
        path: '/create-user',
        component: CreateUser
    },
    {
        name: 'user-detail',
        path: '/user/:id/detail',
        component: UserDetail
    },
    // End Route User

    // Route Products
    {
        name: 'products',
        path: '/products',
        component: Products
    },
    {
        name: 'create-product',
        path: '/create-product',
        component: CreateProduct
    },
    {
        name: 'product-detail',
        path: '/product/:id/detail',
        component: ProductDetail
    },
    // End Route Products

    // Route Orders
    {
        name: 'orders',
        path: '/orders',
        component: Orders
    },
    {
        name: 'create-order',
        path: '/create-order',
        component: CreateOrder
    },
    {
        name: 'order_detail',
        path: '/order/:id/detail',
        component: OrderDetail
    }
    // End Route Orders
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
