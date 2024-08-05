import { createRouter, createWebHistory } from "vue-router";
import AdvertisementList from "../components/AdvertisementList.vue";
import Advertisement from "../components/Advertisement.vue";

const routes = [
    {
        path: "/",
        name: "advertisements",
        component: AdvertisementList,
    },
    {
        path: "/advertisements/:id",
        name: "advertisement",
        component: Advertisement,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
