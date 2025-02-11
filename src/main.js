// Sam 
import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "@/router/index.js";
import Main from "@/Main.vue";
import VCalendar from "v-calendar"; //Ian
import 'v-calendar/style.css'; //Ian


createApp(Main).use(createPinia()).use(router).use(VCalendar, {}).mount('#app');