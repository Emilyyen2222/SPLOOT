# Sass / Scss

## Sass 監控
```bash
sass ./src/assets/sass/style.scss ./src/assets/css/style.css -w
```

## Scss 開發
1. 不要更動除了 `page` 以外的檔案。
2. 需要製作 `mixin` 模組的話，先放置在自己的 `page` 頁面上方，整合時統一整理。
3. 檔名前請加底線，並 `import` 到自己的 `style.scss`。

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

預設字體顏色：咖啡色
```scss
body{ color: map-get($colors, brown); }
```

### 每頁背景顏色、預設字體顏色
在 `body` 設定背景顏色，預設字體顏色，如果沒預設就是上方預設的咖啡色
```html
<body class="bg-blue-0 text-blue-2">
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

### Bayon 字體
```scss
@include bayon(20); // bayon 2rem (20px)
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
justify-content;
align-items;
overflow;

// 外觀（由內到外）
width;
max-width;
height;
box-sizing;
padding;
border;
opacity;
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

// 效果
transform;
transition;
```

---

# Vite / Vue 開發

## 前置事項
可以用`node -v`來看電腦目前使用的版本

### 安裝 Node.js
安裝網址：https://nodejs.org/en

### 安裝 Vite
製作 Vite 專案
```bash
npm create vite@latest
```

### 下載安裝套件
```bash
npm install
```

### 下載 Vue-router
```bash
npm install vue-router@4
```

### 下載 Pinia
```bash
npm install pinia
```

## Vite Vue 開發

### Vite 開發模式
```bash
npm vite dev
```

### Vite 打包建立
```bash
npm vite build
```

## Vue 元件開發
### 都使用 Composition API

---

# 元件

### 按鈕
根據 Figma 按鈕元件風格，支援以下樣式：
- **Style**: `primary`,`blue`, `outline`, `text`, `white`
- **Size**: `large`, `default`, `small`

已調整好顏色、大小、字型、間距
```html
<div class="btn primary large"><span>Button</span></div>
<div class="btn blue default"><span>Button</span></div>
```

### 下拉選單
Q&A 下拉選單
```vue
<DropdownQa 
    question="QQQQQ"
    answer="AAAAA"></DropdownQa>
```
<DropdownMenu
    :placeHolder="menu1.placeHolder"
    :options="menu1.options"></DropdownMenu>
```
---

## 其他開發須知

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
- **`component`**: Vue 元件。(ItemContainer.vue)
- **`pages`**: 頁面 View。(HomeView.vue)
- **`router`**: Vue-router。
- **`vendors`**: 第三方套件（例如 jQuery）。

---

### `.gitignore`
將以下內容忽略，避免上傳：
1. 監控產出的 `.css` 檔案。

```
*.css
*.css.map
```

---