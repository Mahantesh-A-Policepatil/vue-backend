import "./bootstrap";

// vue app entry
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/index.js";

import "bootstrap/dist/css/bootstrap.min.css";
import "../css/app.css";

const app = createApp(App);
app.use(router);
app.mount("#app");
