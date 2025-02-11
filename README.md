# Pinia 

## 登入燈箱套用

引用pinia全域環境下的會員登入介面 以及 設定變數
```vue
<script setup>

    import { useAuthStores } from '@/stores/AuthBoxStores.js';  
    const authBoxStore = useAuthStores();

</script>
```
## 全域變數

可以使用在任何地方的變數以及函式(不需要再次宣告直接使用)，需要在前面加上authBoxStore.
且使用時不用再加上.value，Pinia 會自動幫你做 ref() 的解包
下面有使用範例
```script
<!-- 登入狀態(未登入為false) -->
isLoggedIn

<!-- 登入燈箱開關 -->
toggleAuthBox()
```
## 要啟動登入燈箱的按鈕函式上加上判斷式（使用範例在這～）
# vue
```vue
<button @click="isActionNow">按我(如果我不是會員則跳出登入視窗)</button>

<script setup>

  function isActionNow(){
    if(authBoxStore.isLoggedIn){
      //do somtings
    }else{
      authBoxStore.toggleAuthBox(); //執行開啟燈箱
    }
  };

</script>
```
# Sass / Scss

## Sass 監控
```bash
sass ./src/assets/sass/style.scss ./src/assets/css/style.css -w
```

## Scss 開發
1. 不要更動除了 `page` 以外的檔案。
2. 需要製作 `mixin` 模組的話，先放置在自己的 `page` 頁面上方，整合時統一整理。
3. 檔名前請加底線，並 `import` 到自己的 `style.scss`，按照字母排列順序(VsCode 左側檔案管理的順序)，

## `style.scss` 預設

```scss
html{ font-size: 10px; } // 1rem = 10px;
```

所有元素、偽元素都加上 `box-sizing: border-box`
```scss
*,
*::after,
*::before{
    box-sizing: border-box;
}
```

`a`連結都先把底線拿掉
```scss
a{ text-decoration: none; }
```

### RWD 切版
使用五個斷點：`xs: 390px`, `sm: 576px`, `md: 768px`, `lg: 992px`, `xl: 1216px`
```scss
@include xs() {
    //內容-這段記得刪掉
};
```

#### 顏色使用
```scss
color: map-get($colors, pink-2);
background-color: map-get($colors, blue-2);
border: 1px solid map-get($colors, red);
```

### 設計庫字體
支援以下樣式：`bigText`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `p`, `smallText`, `xsText`  
字體大小、行高、間距均已設置。

```scss
@include textStyle(bigText);
@include textStyle(h1);
@include textStyle(h1, bold); // 粗體
```

### Bayon 字體 (用在某些數字和英文)
```scss
@include bayon(20); // bayon 2rem (20px)
```
如果有需要可以自己做成 class 
```scss
.bayon-20{
    @include bayon(20);
}
```

`<h1>` `<h2>` ... `<span>`標籤
```html
<h1>Title</h1> <!-- 一般 -->
<h1 class="bold">Title</h1> <!-- 粗體 -->
<span class="smallText">Small Text</span>
<span class="smallText bold">Small Bold Text</span>
```

除非是有特別設定，不應該在你的 scss 裡面看到 `font-family`,`font-size`,`font-weight`,`line-height`,`letter-spacing`!!!

### 背景圓圈
固定寬高，只需要填顏色，預設 `z-index: -5`
```scss
@include circle(map-get($colors, pink-1));
```

### CSS 編寫順序
請盡量遵循以下順序，方便尋找與修改：
```css
// 滑鼠指標設定
cursor: pointer;

// 位置
position;
top;
left;
z-index;

// 樣式
display: flex;
flex-wrap;
justify-content;
align-items;
gap;
overflow;

// 外觀框架（由內到外）
width;
max-width;
height;
box-sizing;
padding;
border;
margin;
border-radius;
background-color;

// 內文
font-family;
font-size;
font-weight;
text-align;
text-decoration;
line-height;
color;

// 其他效果變化
opacity;
transform;
transition;
```

---

# Vite / Vue 開發

### 下載安裝套件
已經包含 Vue-router 和 Pinia 了，可以去`package.json`檢查，沒有到話再下載
```bash
npm install
```

### 下載 Vue-router, Pinia (已經包含在 package 裡了)
```bash
npm install vue-router@4
npm install pinia
```

## Vue 開發 (都使用 Composition API)
### Vue-router
- **path**: 網址
- **component**: 這個網址要顯示的畫面 (`xxxView.vue`)
- **meta**: 這個網址要帶入的參數
    - **title**: 網頁上方的網頁名稱
    - **theme**: 上面 header 的主色調 (紅色`red`, 藍色`blue`)
    - **bodyId**: 如果有需要的話才加，body 的 id 名稱
    - **bodyBg**: 網頁的背景顏色
    - **textColor**: 如果有需要的話才加，網頁的預設文字顏色，如果沒有填寫就是咖啡色
  
```vue
{
    path: '/sploot-box',
    component: () => import('@/pages/splootboxView.vue'),
    meta: {
      title: '訂閱寵物盒 | Sploot',
      theme: 'red',
      bodyBg: 'pink-0',
    }
},
```

如果有需要用到點擊連結到其他網頁，原本是用`<a>`標籤
```vue
<a href="./sploot-box.html"><span>首頁</span></a>
```
開發的時候可以用 Vue-router 網頁就不會重整重新載入，會順順的換到下一頁，把`<a>`換成`<RouterLink>`，裡面的 `/sploot`就是上面的 `path`
```vue
<RouterLink to="/sploot-box"><span>首頁</span></RouterLink>
```
### 使用元件
在使用元件之前，都要在下方的`<script setup>`裡面先把元件`import`進來
```vue
<script setup>
    import { ref } from "vue";

    import SimpleCounter from "../components/SimpleCounter.vue";
</script>
```
```vue
<template>
    <SimpleCounter></SimpleCounter>
</template>
```

---

# 已完成元件
## Vue 元件
元件都已經挑整好顏色、大小、字型、風格等等的，只需要選擇風格和調整裡面的文字就好了

## Header
- **theme**：header 的主色 (紅色`red`, 藍色`blue`)
- **bgc**: header 的背景色（跟網頁的背景色一樣）
```vue
import MainHeader from '../components/MainHeader.vue';
```
```vue
<MainHeader theme="red" bgc="purple-1"></MainHeader>
```
## Footer (開發中)

## 一般按鈕
根據 Figma 按鈕元件風格，支援以下樣式：
- **Style**: `primary`,`blue`, `outline`, `text`, `white`
- **Size**: `large`, `default`, `small`

```vue
import Btn from '../components/Btn.vue';
```
```vue
<Btn btnStyle="primary large">查看</Btn>
<Btn btnStyle="blue small">查看</Btn>
```

## 問卷填寫
- **placeHolder**: 放預設文字
- **errorMsg**: 錯誤時顯示的訊息
- **v-model**: 裡面輸入的值(監聽)
- **hasError**: 是否顯示錯誤

```vue
import InputText from '../components/InputText.vue';
```
下面那段不用複製進去，只是展示用 `v-model` 監聽裡面輸入的值 `inputValue`，最後放進下面的`<p>`標籤
```vue
<InputText
    placeHolder="這裡填預設文字"
    errorMsg="Invalid Input"
    v-model="inputValue"
    :hasError="inputError">
</InputText>
<p>用 v-model 監聽: {{ inputValue }}</p>
```
用 `watch` 功能隨時監看 `inputValue`的值，下方展示是用如果輸入的值包含`123`這個字串，就會顯示錯誤
```js
let inputValue = ref('');
let inputError = ref(false);

watch(inputValue, (newValue, oldValue) => {
    if(inputValue.value.includes('123')){
        inputError.value = true;
    }else{
        inputError.value = false;
    }
})
```

## 問卷選擇
- **btnType**:`form`
- **Style**: 選項`option`,下一題`nextQ`,上一題 `lastQ`

問卷選項
```vue
<Btn btnType="form" btnStyle="option">選擇1</Btn>
```

下一題
```vue
<Btn btnType="form" btnStyle="nextQ">下一題</Btn>
```

上一題
```vue
<Btn btnType="form" btnStyle="nextQ">上一題</Btn>
```

## 下拉選單
### Q&A 下拉選單
- **question**：問題
- **answer**：回答
```vue
import DropdownQa from "../components/DropdownQa.vue";
```
```vue
<DropdownQa 
    question="QQQQQ"
    answer="AAAAA"></DropdownQa>
```

### 選項下拉選單
- **placeHolder**：選單預設文字
- **options**：選項
    - **建議**：`placeHolder` `options` 用物件的方式，以防一頁有多個選單，方便管理
```vue
import DropdownMenu from "../components/DropdownMenu.vue";
```
```vue
<DropdownMenu
    :placeHolder="menu1.placeHolder" 
    :options="menu1.options"></DropdownMenu>
```
```js
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
```

## 其他開發須知
### 請 修改/完成 一小部分，一個段落，或一個元件時就先 commit，否則一次要上傳很多個檔案，很容易有衝突。

### Class 命名規則
若需狀態變化，例如下拉選單的閉合與展開：

```html
<!-- 預設閉合狀態 -->
<div class="dropdown-menu">

<!-- 點擊展開狀態 -->
<div class="dropdown-menu -expand">
```
`-expand` 前置加 `-` 號表示狀態。

---

## 檔案結構

### `default.html`
開發初始模板，請複製此檔案進行網頁開發。

### `src`
- **`assets`**: 前端所需資源（CSS、Img、JS、Sass）。
- **`component`**: Vue 元件。(ItemContainer.vue)。
- **`pages`**: 頁面 View。(HomeView.vue)
- **`router`**: Vue-router。
- **`vendors`**: 第三方套件（例如 jQuery）。

---

# 彈出式視窗

## 多重彈出式視窗說明
當同一頁面有兩個以上的彈出式視窗時，所有變數與函式都需要修改名稱並複製新的函式，例如：

- `toggleLightBox` -> `toggleLightBox2`
- `lightTitle` -> `lightTitle2`
- `isLightBox` -> `isLightBox2`

範例函式：

```script
function toggleLightBox2() {
  // 新的燈箱控制邏輯
}
```

## 燈箱
內建功能：
1. 自動關閉燈箱的按鈕。
2. 內容超出長度時自動生成捲軸。
3. 預設設定了 `padding`、遮罩及定位。

只需將內容填入即可使用。

### template
```vue
<LightBox 
    :title="lightTitle.title"
    :is-light-box="isLightBox" 
    @toggle="toggleLightBox">

    <!-- 輸入燈箱內容 -->

</LightBox>

<!-- 控制燈箱的按鈕 -->
<button @click="toggleLightBox">開啟燈箱</button>
```

### Script
```vue
<script setup>
import LightBox from "@/components/LightBox.vue";
import { ref } from 'vue';

// 1. 主標題請輸入在這裡 
const lightTitle = { title: "我是預設標題，請多指教" };

// 2. 燈箱開關
// 燈箱狀態
let isLightBox = ref(false);

// 控制燈箱的顯示與隱藏
function toggleLightBox() {
  isLightBox.value = !isLightBox.value;
  // 根據狀態新增或移除 `clicked` 類別
  if (isLightBox.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}
</script>
```

## 彈出視窗 (Pop-Up)
內建功能：
1. 預設 `padding`、遮罩及定位。
2. 不含任何內部架構。

只需將內容填入即可使用。

### HTML
```vue
<PopUp :is-pop-up="isPopUp">
    <!-- 輸入燈箱內容 -->
</PopUp>

<!-- 控制彈出視窗的按鈕 -->
<button @click="togglePopUp">開啟彈出視窗</button>
```

### Script
```vue
<script setup>
import PopUp from "../components/PopUp.vue";
import { ref } from 'vue';

// popup 狀態
let isPopUp = ref(false);

// 控制彈出視窗的顯示與隱藏
function togglePopUp() {
  isPopUp.value = !isPopUp.value;
  // 停止捲軸
  if (isPopUp.value) {
    document.body.classList.add('clicked');
  } else {
    document.body.classList.remove('clicked');
  }
}
</script>
```


# authBox登入註冊使用說明

### HTML
```vue
<authBox
    v-model:authType="authType" 
    :isAuthBox="isAuthBox" 
    @toggle="toggleAuthBox"
  ></authBox>

<!-- 在需要觸發顯示authBox的按鈕標籤上添加： -->
<Btn @click="toggleAuthBox"></Btn>

```
### `authType` 說明
- **註冊**：`authType="signUp"`
- **登入**：`authType="login"`

## Script
```vue
<script setup>

//設定初始模式（登入or註冊） login：登入  signUp：註冊
const authType = ref('login');
// 登入或註冊框狀態
let isAuthBox = ref(false);

// 控制登入或註冊框的顯示與隱藏
function toggleAuthBox() {
  isAuthBox.value = !isAuthBox.value;

  // 停止捲軸
  if (isAuthBox.value) {
    document.body.classList.add('authClicked');
  } else {
    document.body.classList.remove('authClicked');
  }
}
</script>
```


