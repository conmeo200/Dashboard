import {createRouter, createWebHistory} from "vue-router";

// route auth
import Login from "./components/Auth/Login.vue";
import Register from "./components/Auth/Register.vue";
import Forgotpassword from "./components/Auth/Forgotpassword.vue";

import Hooks from "./components/Generate/Hooks.vue";

// url pages
import home from "./components/Page/home";
import tags from "./components/Page/tags";
import blogs from "./components/Page/blogs";
import blog_detail from "./components/Page/blogDetail";

// route users
import Users      from "./components/User/Users.vue";
import UserDetail from "./components/User/UserDetail.vue";
import CreateUser from "./components/User/CreateUser.vue";

// route products
import Products      from "./components/Products/Products.vue";
import ProductDetail from "./components/Products/ProductDetail.vue";
import CreateProduct from "./components/Products/CreateProduct.vue";

// route orders
import Orders      from "./components/Orders/Orders.vue";
import OrderDetail from "./components/Orders/OrderDetail.vue";
import CreateOrder from "./components/Orders/CreateOrder.vue";

const routes = [
    {
        name: 'home',
        path: '/',
        component: home
    },
    {
        name: 'tags',
        path: '/tags',
        component: tags
    },
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
    },
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

    // hooks vue
    {
        name: 'hooks',
        path: '/hooks',
        component: Hooks,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
