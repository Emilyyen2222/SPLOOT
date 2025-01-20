// Sam 
import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "@/router/index.js";
import Main from "@/components/Main.vue";

const pinia = createPinia();

createApp(Main).use(router).use(pinia).mount('#app');