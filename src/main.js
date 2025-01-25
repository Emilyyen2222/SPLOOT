// Sam 
import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "@/router/index.js";
import Main from "@/Main.vue";
import VCalendar from "v-calendar"; //Ian
import 'v-calendar/style.css'; //Ian

const pinia = createPinia();

createApp(Main).use(router).use(pinia).use(VCalendar, {}).mount('#app');