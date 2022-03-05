import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./components/DashboardComponent.vue";


Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home,
        },
    ],
});

export default router;
