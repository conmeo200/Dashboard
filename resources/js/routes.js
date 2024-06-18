import {createRouter, createWebHistory} from "vue-router";

import Dashboard from "./components/Dashboard/Dashboard";
import User from "./components/User/User";
import Role from "./components/Role/Role";
import Log from "./components/Log/Log";


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
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
