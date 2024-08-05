import "./bootstrap";
import { createApp } from "vue";
import App from "./App.vue";

import axios from "axios";
import VueAxios from "vue-axios";
import router from "./routes";
import vuetify from "./vuetify";

const app = createApp(App);

app.use(VueAxios, axios).use(vuetify).use(router).mount("#app");
