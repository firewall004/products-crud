import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const Home = () => import('../views/Home.vue');
const Login = () => import("../views/Auth/Login.vue");
const Register = () => import("../views/Auth/Register.vue");

const guest = (to, from, next) => {
  if (!localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};
const auth = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/login");
  }
};

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/loginAdmin",
    name: "LoginAdmin",
    beforeEnter: guest,
    component: Login,
	props: { userType: 'admin' }
  },
  {
    path: "/loginVendor",
    name: "LoginVendor",
    beforeEnter: guest,
    component: Login,
	props: { userType: 'vendor' }
  },
  {
    path: "/register",
    name: "Register",
    beforeEnter: guest,
    component: Register
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
