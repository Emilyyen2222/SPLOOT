哪裡看不懂或寫不夠清楚再跟我說～


sass 監控
    sass ./src/assets/sass/style.scss ./src/assets/css/style.css -w

vite 開發
    npm vite dev

vite 打包建立
    npm vite build



開發
    rwd切版：五個斷點 xs, sm, md, lg, xl
        @include xs(){
            內容
        }
        @include sm(){
            內容
        }

    每頁背景顏色:
        <body class="bg-pink-2"> //放在最上面
    顏色:
        color: map-get($colors, pink-2);
        background-color: map-get($colors, blue-2);

    設計庫字體：
        bigText, h1, h2, h3, h4, h5, h6, p, smallText, xsText //大小、行高、間距都設好了

        @include textStyle(bigText);
        @include textStyle(h1);
        @include textStyle(h1, bold); //粗體

        如果 html 裡 <h1> <h2> 等等標籤需要粗體，在class加 bold
        <h1 class="bold">Title</h1>  

    bayon字體：
        @include bayon(20);//bayon 2rem (20px);

    背景圓圈：
        @include circle($bgc);



Vue 元件: 下面的會被做成 vue 元件，但如果有需要先用的，可以去 ds.html 看怎麼用

    按紐: 看 figma 按紐元件風格 (之後會做成 vue 元件)
        Style: primary, outline, text, white
        Size: large, default, small
        都調整好顏色大小字型間距了

        class="btn primary large"
        class="btn outline default"

    下拉選單: (之後會做成 vue 元件)
        dropdown-qa 用在 Q&A 的下拉式選單
        dropdown-menu 一般下拉式選單 

        一樣都調整好顏色大小字型間距了


開發
    sass 
        進亮不要動到除了 page 以外的東西
        如果有需要做 mixin 的，先做在自己 page 的上面
        等大家上傳完之後，再統一整合，不然很容易有衝突
        記得在檔名前面加底線，然後import 進自己的 style.scss

    class
        如果有需要變化的東西，例如下拉選單有預設的閉合和點擊後的展開，
        在 className 前面加一個減號，來去做變化
        例如 ->
            class="dropdown-menu" 這個是預設閉合的狀態
            class="dropdown-menu -expand" 這個是點擊展開的狀態
            -expand 前面有加減號
        可以去參考 ds.html 下拉選單的寫法

    css 
        如果有要 @include 的話，先寫在最上面
        
    css 編譯順序
        如果可以的話再遵守就好，只是比較方便閱讀跟改動

        cursor: pointer
        // 位置
        position
        top: 0
        left: 0

        // 樣式
        display: flex;
        justify-content
        align-items

        // 外觀 （由內到外）
        width
        max-width
        height
        box-sizing
        padding
        border
        margin
        border-radius
        background-color

        // 內文
        fontfamily
        fontsize
        fontweight
        text-align
        text-decoration
        line-height
        color

-----------------------------------------------------
src
    assets //放前端會用到的東西，包含 css img js sass 
    component //放 Vue component
    vendors //第三方套件，例如jquery

.gitignore
    讓 git 忽略掉下面的開發，就不會上傳
    -> 每個人的各自開發的頁面 css (sass/page 裡面的 scss)內容一定不一樣，css檔案上傳的話一定會有衝突，所以要忽略掉，自己的css應該都要是等別人上傳並拉下來之後，透過監控自己的 style.scss 去產出自己的 style.css 檔
    目前有下面這些 (換到 vite 開發的時候可能會有變動)

    CSS
    css
    .vscode

default.html
    Html 初始模板，開發網頁前從這個複製