import {createRouter, createWebHistory} from "vue-router";

import Dashboard from "./components/Dashboard/Dashboard.vue";
import User from "./components/User/User.vue";
import Role from "./components/Role/Role.vue";
import Log from "./components/Log/Log.vue";
import Notifications from "./components/Notification/Notifications.vue";
import Form from "./components/Form/Form.vue";
import Products from "./components/Products/Products.vue";
import CreateProduct from "./components/Products/CreateProduct.vue";
import LeadForm from "./components/LeadForm/FormTest.vue";
import Login from "./components/Auth/Login.vue";
import Register from "./components/Auth/Register.vue";
import Forgotpassword from "./components/Auth/Forgotpassword.vue";
import Hooks from "./components/Generate/Hooks.vue";

// url pages
import home from "./components/Page/home";
import tags from "./components/Page/tags";
import blogs from "./components/Page/blogs";
import blog_detail from "./components/Page/blogDetail";


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
        name: 'Dashboard',
        path: '/dashboard',
        component: Dashboard,
        meta: { breadcrumb: 'Dashboard', page: 'Dashboard' }
    },
    {
        name: 'User',
        path: '/user',
        component: User,
        meta: { breadcrumb: 'User', page: 'User' }
    },
    {
        name: 'Role',
        path: '/role',
        component: Role,
        meta: { breadcrumb: 'Role', page: 'Role' }
    },
    {
        name: 'Log',
        path: '/log',
        component: Log,
        meta: { breadcrumb: 'Log', page: 'Log' }
    },
    {
        name: 'Notifications',
        path: '/notifications',
        component: Notifications,
        meta: { breadcrumb: 'Notifications', page: 'Notifications' }
    },
    {
        name: 'Form',
        path: '/form',
        component: Form,
    },
    {
        name: 'Products',
        path: '/products',
        component: Products,
    },
    {
        name: 'CreateProduct',
        path: '/create-product',
        component: CreateProduct,
    },
    {
        name: 'LeadForm',
        path: '/leadform',
        component: LeadForm,
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
