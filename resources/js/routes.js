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

// component paypal
import Payments      from "./components/PayPal/List.vue";
import Cancel        from "./components/PayPal/Cancel.vue";
import Success       from "./components/PayPal/Success.vue";
import CreatePayment from "./components/PayPal/Create.vue";

const routes = [
    
    // Route Payments
    {
        name: 'Payments',
        path: '/payments',
        component: Payments,
    },
    {
        name: 'Payment Cancel',
        path: '/payment-cancel',
        component: Cancel,
    },
    {
        name: 'Payment Success',
        path: '/payment-success',
        component: Success,
    },
    {
        name: 'Create Payment',
        path: '/create-payment',
        component: CreatePayment,
    },

    // End Route Payments

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
        component: home,
        meta: { requiresAuth: true }
    },
    // End Route Home

    // Route Permissions
    {
        name: 'permissions',
        path: '/permissions',
        component: Permissions,
        meta : {requiresAuth : true}
    },
    {
        name: 'create-permission',
        path: '/create-permission',
        component: CreatePermission,
        meta : {requiresAuth : true}
    },
    {
        name: 'permission-detail',
        path: '/permission/:id/detail',
        component: PermissionDetail,
        meta : {requiresAuth : true}
    },
    // End Route Permissions

    // Route Roles
    {
        name: 'roles',
        path: '/roles',
        component: Roles,
        meta : {requiresAuth : true}
    },
    {
        name: 'create-role',
        path: '/create-role',
        component: CreateRole,
        meta : {requiresAuth : true}
    },
    {
        name: 'role-detail',
        path: '/role/:id/detail',
        component: RoleDetail,
        meta : {requiresAuth : true}
    },
    // End Route Roles

    // Route Tag
    {
        name: 'tags',
        path: '/tags',
        component: tags,
        meta : {requiresAuth : true}
    },
    // End Route Tag

    // Route Blog
    {
        name: 'blogs',
        path: '/blogs',
        component: blogs,
        meta : {requiresAuth : true}
    },
    {
        name: 'blog_detail',
        path: '/blog/:id/detail',
        component: blog_detail,
        meta : {requiresAuth : true}
    },
    // End Route Blog

    // Route User
    {
        name: 'users',
        path: '/users',
        component: Users,
        meta : {requiresAuth : true}
    },
    {
        name: 'create-user',
        path: '/create-user',
        component: CreateUser,
        meta : {requiresAuth : true}
    },
    {
        name: 'user-detail',
        path: '/user/:id/detail',
        component: UserDetail,
        meta : {requiresAuth : true}
    },
    // End Route User

    // Route Products
    {
        name: 'products',
        path: '/products',
        component: Products,
        meta : {requiresAuth : true}
    },
    {
        name: 'create-product',
        path: '/create-product',
        component: CreateProduct,
        meta : {requiresAuth : true}
    },
    {
        name: 'product-detail',
        path: '/product/:id/detail',
        component: ProductDetail,
        meta : {requiresAuth : true}
    },
    // End Route Products

    // Route Orders
    {
        name: 'orders',
        path: '/orders',
        component: Orders,
        meta : {requiresAuth : true}
    },
    {
        name: 'create-order',
        path: '/create-order',
        component: CreateOrder,
        meta : {requiresAuth : true}
    },
    {
        name: 'order_detail',
        path: '/order/:id/detail',
        component: OrderDetail,
        meta : {requiresAuth : true}
    }
    // End Route Orders
];
  
const router = createRouter({
    history: createWebHistory(),
    routes
});

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         const token = localStorage.getItem('isAuth'); 
  
//         if (!token) next({ name: 'Login' });
//         else next();
//     } else {
//         next();
//     }
// });

export default router;
