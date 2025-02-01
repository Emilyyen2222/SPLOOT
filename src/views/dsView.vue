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
    <Btn btnStyle="text large">Test</Btn>
    <section>
        <h4>問卷問題</h4>
        <div style="flex-direction: column; gap: 8px; padding: 10px; margin: 0 auto">
            <h6>Input (預設字置中)</h6>
            <InputText
                :placeHolder="input1.placeHolder"
                :errorMsg="input1.errorMsg"
                :hasError="input1.inputError.value"
                v-model="input1.inputValue.value">
            </InputText>
            <p>用 v-model 監聽: {{ input1.inputValue }}</p>

            <h6>Input (字靠左): textAlign = "textLeft"</h6>
            <InputText
                :textAlign="input2.textAlign"
                :placeHolder="input2.placeHolder"
                :errorMsg="input2.errorMsg"
                :hasError="input2.inputError.value"
                v-model="input2.inputValue.value">
            </InputText>
            <p>用 v-model 監聽: {{ input2.inputValue }}</p>

            <h6>Input (小) size = "small"</h6>
            <InputText
                :size = "input3.size"
                :textAlign = "input3.textAlign"
                :placeHolder="input3.placeHolder"
                :errorMsg="input3.errorMsg"
                :hasError="input3.inputError.value"
                v-model="input3.inputValue.value">
            </InputText>
            <p>用 v-model 監聽: {{ input3.inputValue }}</p>

            <h6>Option</h6>
            <Btn v-for="option in form1.options" :key="option"
            btnType="form" btnStyle="option" 
            :class="{'-active': optionSelected(form1.selected, option)}"
            @click="form1.formChoice(form1.selected, option)">{{ option }}</Btn>

            <p>Selected Options: {{ form1.selected.value.join(' , ') }}</p>



            <Btn v-for="option in form2.options" :key="option"
            btnType="form" btnStyle="option" 
            :class="{'-active': optionSelected(form2.selected, option)}"
            @click="form2.formChoice(form2.selected, option)">{{ option }}</Btn>

            <p>Selected Options: {{ form2.selected.value.join(' , ') }}</p>

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
            <DropdownMenu 
            :placeHolder="menu1.placeHolder"
            :options="menu1.options"
            v-model="menu1.menuValue.value"></DropdownMenu>

            <p>用 v-model 監聽: {{ menu1.menuValue }}</p>


            <h6>DropdownMenu (size="large")</h6>
            <DropdownMenu size="large"
            :placeHolder="menu2.placeHolder"
            :options="menu2.options"
            v-model="menu2.menuValue.value"></DropdownMenu>
            
            <p>用 v-model 監聽: {{ menu2.menuValue }}</p>
        </div>
    </section>
    <section>
        <h4>LightBox燈箱</h4>
        <p @click="toggleLightBox"
        style="
        cursor: pointer;
        text-decoration: underline;
        ">按下去</p>
        <LightBox 
        :title="lightTitle.title"
        :is-light-box="isLightBox" 
        @toggle="toggleLightBox">
        
        <div 
        style="
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        ">
        <h2 class="bold" style="text-align: center;">請輸入內容<br>往下滑動</h2>
    
        </div>
        <div 
        style="
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        ">
        <h2 class="bold">請輸入內容</h2>
    
        </div>
            
        </LightBox>
    </section>


    <section>

        <h4>TagBtn</h4>
        <div style="flex-direction: column; gap: 8px; padding: 10px; margin: 0 auto">
            <Btn v-for="option in tag1.options" :key="option"
            btnType="tag" 
            :class="{'-active': optionSelected(tag1.selected, option)}"
            @click="tag1.formChoice(tag1.selected, option)">{{ option }}</Btn>
            <p>Selected Options: {{ tag1.selected.value.join(' , ') }}</p>
        </div>
    </section>
    <ProgressBar :total="10" :current="currentProgress" ></ProgressBar>
    <MainFooter class="bg-yellow-2"></MainFooter>
</template>

<script setup>
import { ref, watch } from "vue";

import MainHeader from '../components/MainHeader.vue';
import MainFooter from '../components/MainFooter.vue';
import Btn from '../components/Btn.vue';
import InputText from '../components/InputText.vue';
import DropdownQa from "../components/DropdownQa.vue";
import DropdownMenu from "../components/DropdownMenu.vue";
import ProgressBar from "../components/ProgressBar.vue";
import LightBox from "../components/LightBox.vue";

const btnStyles = ['primary', 'white', 'outline', 'baseline', 'text'];
const btnSizes = ['large', 'default', 'small'];

// 問卷問題的 Input Value 監聽
const input1 = {
    placeHolder: '這裡填預設文字',
    errorMsg: '這是錯誤訊息',
    inputValue: ref(''),
    inputError: ref(false),
}
const input2 = {
    textAlign: 'textLeft',
    placeHolder: '這裡填預設文字',
    inputError: ref(false),
    inputValue: ref(''),
}
const input3 = {
    size: 'small',
    textAlign: 'textLeft',
    placeHolder: '這裡填預設文字',
    inputError: false,
    inputValue: ref(''),
}

watch(input1.inputValue, (newValue, oldValue) => {
    if (input1.inputValue.value.includes('123')) {
        input1.inputError.value = true;
    } else {
        input1.inputError.value = false;
    }
})
watch(input2.inputValue, (newValue, oldValue) => {
    if (input2.inputValue.value.includes('123')) {
        input2.inputError.value = true;
    } else {
        input2.inputError.value = false;
    }
})
// 問卷問題的選項
const form1 = {
    formChoice: singleChoice,
    options: ['表單選項1', '表單選項2', '表單選項3', '表單選項4'],
    selected: ref([]),
};
const form2 = {
    formChoice: multipleChoice,
    options: ['表單選項1', '表單選項2', '表單選項3', '表單選項4'],
    selected: ref([]),
};
const tag1 = {
    formChoice: multipleChoice,
    options: ['標籤選項1', '標籤選項2', '標籤選項3', '標籤選項4'],
    selected: ref([]),
};

function singleChoice(selected, option) {
    selected.value = [option];
    // console.log(selected.value);
}
function multipleChoice(selected, option) {
    if (optionSelected(selected, option)) {
        selected.value = selected.value.filter(opt => opt !== option);
    } else {
        selected.value.push(option);
    }
    // console.log(selected.value);
}
const optionSelected = (selected, option) => {
    return selected.value.includes(option);
}


// 下拉選單的選單管理
const menu1 = {
    placeHolder: '請選擇一個選項',
    options: [
        { id: 0, name: '下拉選項1' },
        { id: 1, name: '下拉選項2' },
        { id: 2, name: '下拉選項3' },
        { id: 3, name: '下拉選項4' },
    ],
    menuValue: ref('')
};
const menu2 = {
    placeHolder: '請選擇一個選項',
    options: [
        { id: 0, name: '下拉選項1' },
        { id: 1, name: '下拉選項2' },
        { id: 2, name: '下拉選項3' },
        { id: 3, name: '下拉選項4' },
    ],
    menuValue: ref('')
};

// LightBox燈箱
// 燈箱標題請輸入
const lightTitle = {title: "請輸入標題"}

 //燈箱狀態
let isLightBox = ref(false);

// 控制燈箱的顯示與隱藏
function toggleLightBox() {
  isLightBox.value = !isLightBox.value;
  // 停止捲軸
  if (isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}

const currentProgress = ref(3);
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