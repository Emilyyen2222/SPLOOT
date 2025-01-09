<template>
    <banner></banner>

    <section class="buttons">
        <h4>Buttons</h4>
        <div style="flex-direction: column">
            <div class="btn primary large"><span>btn primary large</span></div>
            <div class="btn primary default"><span>btn primary default</span></div>
            <div class="btn primary small"><span>btn primary small</span></div>
            <div class="btn blue large"><span>btn blue large</span></div>
            <div class="btn blue default"><span>btn blue default</span></div>
            <div class="btn blue small"><span>btn blue small</span></div>
            <div class="btn outline large"><span>btn outline large</span></div>
            <div class="btn outline default"><span>btn outline default</span></div>
            <div class="btn outline small"><span>btn outline small</span></div>
            <div class="btn text large"><span>btn text large</span></div>
            <div class="btn text default"><span>btn text default</span></div>
            <div class="btn text small"><span>btn text small</span></div>
            <div class="btn white large"><span>btn white large</span></div>
            <div class="btn white default"><span>btn white default</span></div>
            <div class="btn white small"><span>btn white small</span></div>
        </div>
    </section>

    <section class="dropdowns">
        <h4>Dropdowns (還沒加動畫)</h4>
        <div style="flex-direction:column">
            <DropdownQa 
                question="QQQQQ"
                answer="AAAAA"></DropdownQa>
            <DropdownMenu
                placeHolder="請選擇一個選項"
                :menuItems="menuItems"></DropdownMenu>
        </div>
    </section>
</template>

<script setup>
    import { ref } from "vue";

    import Banner from "../components/Banner.vue";
    import DropdownQa from "../components/DropdownQa.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";

    const menuItems = [
        {
            id: 0,
            name: '選項1'
        },
        {
            id: 1,
            name: '選項2'
        },
        {
            id: 2,
            name: '選項3'
        },
        {
            id: 3,
            name: '選項4'
        },
    ]
</script>

<style>
    body { padding: 20px; background-color: #EEE;}
    section{ margin: 80px 0}
    section > div{ display: flex; gap: 20px; }
</style>