<!-- Sam -->
<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
    <h4 style="margin: 20px 0">首頁還沒切元件庫先當首頁</h4>
    <section class="buttons">

        <h4>Buttons (完成)</h4>
        <div style="flex-direction: column">
            <template v-for="style in btnStyles">
                <template v-for="size in btnSizes">
                    <div style="display: flex; flex-direction: column; align-items: center;">
                        <h6>btn {{ style }} {{ size }}</h6>
                        <div class="btnBox" :class="`${size}Box`">
                            <div :class="['btn', style, size]"><span>查看</span></div>
                        </div>
                    </div>
                </template>
            </template>
        </div>
    </section>
    <section>
        <h4>問卷問題</h4>
        <div style="flex-direction: column; gap: 8px; padding: 10px; margin: 0 auto">
            <h6>btn option</h6>
            <div class="questionBox">
                <div class="btn option"><span>選項1</span></div>
            </div>
            <div class="questionBox">
                <div class="btn option"><span>選項2</span></div>
            </div>
            <div class="questionBox">
                <div class="btn option"><span>選項3</span></div>
            </div>
            <h6>btn nextQ</h6>
            <div class="questionBox">
                <div class="btn nextQ"><span>下一題</span></div>
            </div>
            <h6>btn lastQ</h6>
            <div class="questionBox">
                <div class="btn lastQ"><span>上一題</span></div>
            </div>
        </div>
    </section>
    <section class="dropdowns">
        <h4>Dropdowns (還沒加動畫)</h4>
        <div style="flex-direction:column">
            <h6>DropdownQa</h6>
            <DropdownQa question="QQQQQ" answer="AAAAA"></DropdownQa>
            <h6>DropdownMenu</h6>
            <DropdownMenu :placeHolder="menu1.placeHolder" :options="menu1.options"></DropdownMenu>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";

import MainHeader from '../components/MainHeader.vue';
import DropdownQa from "../components/DropdownQa.vue";
import DropdownMenu from "../components/DropdownMenu.vue";

const btnStyles = ['primary', 'blue', 'white', 'outline', 'text', 'textBlue', 'textRed'];
const btnSizes = ['large', 'default', 'small'];
const menu1 = {
    placeHolder: '請選擇一個選項',
    options: [
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
};
</script>

<style>
section {
    width: 100%;
    padding: 0 10px;
    margin: 40px 0
}

section>div {
    display: flex;
    gap: 20px;
}

section>hr {
    border: 1px solid #693413;
    margin: 20px auto
}

.largeBox {
    width: 134px;
}

.defaultBox {
    width: 98px;
}

.smallBox {
    width: 68px;
}
</style>