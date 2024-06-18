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
    },
    {
        name: 'User',
        path: '/user',
        component: User,
    },
    {
        name: 'Role',
        path: '/role',
        component: Role,
    },
    {
        name: 'Log',
        path: '/log',
        component: Log,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
