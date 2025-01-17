<!-- Sam -->
<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
    <h4 style="margin: 20px 0">首頁還沒切元件庫先當首頁</h4>
    <section class="buttons">

        <h4>Buttons (完成)</h4>
        <div style="flex-direction: column">
            <template v-for="style in btnStyles">
                <div style="display: flex;">
                    <template v-for="size in btnSizes">
                        <div style="display: flex; flex-direction: column; align-items: center; width: 200px">
                            <h6>{{ style }} {{ size }}</h6>
                            <Btn :class="`${size}Box`" :btnStyle="`${style} ${size}`">查看</Btn>
                        </div>
                    </template>
                </div>
                <br>
            </template>
        </div>
    </section>
    <section>
        <h4>問卷問題</h4>
        <div style="flex-direction: column; gap: 8px; padding: 10px; margin: 0 auto">
            <h6>Input</h6>
            <InputText placeHolder="這裡填預設文字" errorMsg="Invalid Input" v-model="inputValue" :hasError="inputError">
            </InputText>
            <p>用 v-model 監聽: {{ inputValue }}</p>

            <h6>Option</h6>
            <Btn btnType="form" btnStyle="option" v-model="selectedOptions">選項1</Btn>
            <Btn btnType="form" btnStyle="option" v-model="selectedOptions">選項2</Btn>
            <Btn btnType="form" btnStyle="option" v-model="selectedOptions">選項3</Btn>
            <p>用 v-model 監聽: {{ selectedOptions.join(' , ') }}</p>

            <h6>nextQ</h6>
            <Btn btnType="form" btnStyle="nextQ">上一題</Btn>
            <h6>lastQ</h6>
            <Btn btnType="form" btnStyle="lastQ">下一題</Btn>
        </div>
    </section>
    <section>
        <h4>活動參加</h4>
        <div style="flex-direction: column; gap: 8px; padding: 10px; margin: 0 auto">
            <h6>預設</h6>
            <Btn btnType="event" btnStyle="attend">參加</Btn>
            <h6>可編輯</h6>
            <Btn btnType="event" btnStyle="edit">編輯</Btn>
            <h6>已參加</h6>
            <Btn btnType="event" btnStyle="registered">已參加</Btn>
            <h6>額滿</h6>
            <Btn btnType="event" btnStyle="disable">已額滿</Btn>
        </div>
    </section>
    <section class="dropdowns">
        <h4>Dropdowns (還沒加動畫)</h4>
        <div style="flex-direction:column">
            <h6>DropdownQa</h6>
            <DropdownQa question="這裡是問題" answer="這裡是回答"></DropdownQa>
            <h6>DropdownMenu</h6>
            <DropdownMenu :placeHolder="menu1.placeHolder" :options="menu1.options"></DropdownMenu>
        </div>
    </section>

</template>

<script setup>
import { ref, watch } from "vue";

import MainHeader from '../components/MainHeader.vue';
import Btn from '../components/Btn.vue';
import InputText from '../components/InputText.vue';
import DropdownQa from "../components/DropdownQa.vue";
import DropdownMenu from "../components/DropdownMenu.vue";

const btnStyles = ['primary', 'white', 'outline', 'baseline', 'text'];
const btnSizes = ['large', 'default', 'small'];

// 問卷問題的 Input Value 監聽
let inputValue = ref('');
let inputError = ref(false);

watch(inputValue, (newValue, oldValue) => {
    if (inputValue.value.includes('123')) {
        inputError.value = true;
    } else {
        inputError.value = false;
    }
})

// 問卷問題的選項
const selectedOptions = ref([]);

// 下拉選單的選單管理
const menu1 = {
    placeHolder: '請選擇一個選項',
    options: [
        { id: 0, name: '選項1' },
        { id: 1, name: '選項2' },
        { id: 2, name: '選項3' },
        { id: 3, name: '選項4' },
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