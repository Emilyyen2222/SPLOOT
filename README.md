## 指令

## Sass 監控
```bash
sass ./src/assets/sass/style.scss ./src/assets/css/style.css -w
```

## Vite 開發
```bash
npm vite dev
```

## Vite 打包建立
```bash
npm vite build
```

---

## 開發指南

### 已經在 `style.scss`裡預設好了
1rem = 10px
```scss
html{ font-size: 10px; }
```

所有元素、偽元素都加上 box-sizing: border-box
```scss
*,
*::after,
*::before{
    box-sizing: border-box;
}
```

a連結都先把底限拿掉
```scss
a{ text-decoration: none; }
```

預設字體顏色是咖啡色
```scss
body{ color: map-get($colors, brown); }
```
除非有特別需求，不應該在`scss`裡看到`box-sizing`

### RWD 切版
使用五個斷點：`xs`, `sm`, `md`, `lg`, `xl`
```scss
@include xs() {
    //內容-這段記得刪掉
};
@include sm() {
    //內容-這段記得刪掉
};
```

### 每頁背景顏色、預設字體顏色
將 `body` class 設定在最上層：
```html
<body class="bg-blue-0 text-blue-2">
```

#### 顏色設定
```scss
color: map-get($colors, pink-2);
background-color: map-get($colors, blue-2);
```

### 設計庫字體
支援以下樣式：`bigText`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `p`, `smallText`, `xsText`  
字體大小、行高、間距均已設置。

```scss
@include textStyle(bigText);
@include textStyle(h1);
@include textStyle(h1, bold); // 粗體
```
所以，除非是有特別設定，不應該在你的 scss 裡面看到 `font-family`,`font-size`,`font-weight`,`line-height`,`letter-spacing`!!!

HTML 標籤範例：
```html
<h1>Title</h1> <!-- 一般 -->
<h1 class="bold">Title</h1> <!-- 粗體 -->
<span class="smallText">Small Text</span>
<span class="smallText bold">Small Bold Text</span>
```

### Bayon 字體
```scss
@include bayon(20); // bayon 2rem (20px)
```

### 背景圓圈
```scss
@include circle($bgc);
```

---

## Vue 元件 (開發中，但如果有需要先用可以參考 ds.html)

### 按鈕
根據 Figma 按鈕元件風格，支援以下樣式：
- **Style**: `primary`, `outline`, `text`, `white`
- **Size**: `large`, `default`, `small`

已調整好顏色、大小、字型、間距：
```html
<div class="btn primary large">Button</div>
<div class="btn outline default">Button</div>
```

### 下拉選單
- `dropdown-qa`: 用於 Q&A 下拉選單
- `dropdown-menu`: 一般下拉選單

---

## 開發須知

### Sass
1. 請勿更動除了 `page` 以外的檔案。
2. 需要製作 `mixin` 的，先放置在自己的 `page` 頁面上方，待整合時統一整理。
3. 檔名前請加底線，並 `import` 到自己的 `style.scss`。

### Class 命名規則
若需狀態變化，例如下拉選單的閉合與展開：

```html
<!-- 預設閉合狀態 -->
<div class="dropdown-menu">

<!-- 點擊展開狀態 -->
<div class="dropdown-menu -expand">
```
`-expand` 前置加 `-` 號表示狀態。

### CSS 編寫順序
如果可以，請盡量遵循以下順序，方便閱讀與修改：
```css
// 滑鼠指標設定
cursor: pointer;

// 位置
position;
top;
left;

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

## 檔案結構

### `default.html`
開發初始模板，請複製此檔案進行網頁開發。

### `src`
- **`assets`**: 放置前端所需資源（CSS、Img、JS、Sass）。
- **`component`**: 放置 Vue 元件。
- **`vendors`**: 放置第三方套件（例如 jQuery）。

---

### `.gitignore`
將以下內容忽略，避免上傳：
1. 監控產出的 `.css` 檔案。

目前需忽略：
```
*.css
*.css.map
```

---