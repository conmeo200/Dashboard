import {createRouter, createWebHistory} from "vue-router";

import Dashboard from "./components/Dashboard/Dashboard";
import User from "./components/User/User";
import Role from "./components/Role/Role";
import Log from "./components/Log/Log";
import Notifications from "./components/Notification/Notifications";
import Form from "./components/Form/Form";
import Products from "./components/Products/Products";
import CreateProduct from "./components/Products/CreateProduct";
import LeadForm from "./components/LeadForm/FormTest.vue";
import Item from "./components/Item/Item.vue";


const routes = [
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
        name: 'Item',
        path: '/item',
        component: Item,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
