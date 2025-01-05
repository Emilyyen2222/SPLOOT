下面所有東西換到 vite 開發的時候，應該有很多東西都會有變
哪裡看不懂或寫不夠清楚再跟我說～

指令
    sass 監控 (換到 vite 開發的時候可能會有變動)
        sass 監控的檔案位置 監控輸出的檔案位置
        sass sass/style.scss css/style.css

    vite 開發
        npm vite dev

    vite 打包建立
        npm vite build


mixin 使用:
    rwd切版：五個斷點 xs, sm, md, lg, xl
        @include xs(){
            內容
        }
        @include sm(){
            內容
        }

    bayon 字體：
        @include bayon(字體大小); (已經調好行高等等的，只需要填大小就好)
        bayon 20px -> @include bayon(20);

    引入 h1 300 字體：
        @include h1(); (已經調好大小、粗細、行高)
        h1 500 粗字體：
        @include h1(bold);




    




    下面的會被做成 vue 元件，但如果有需要先用的，可以去 ds.html 看怎麼用

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





_demo
    放一些套件的地方

    ds.html 放做好的元件庫
    fullPageScroll.html 頁面區塊滑動的效果
css
    經過 sass 監控完的 css 檔
    裡面應該只會有兩個檔案 style.css 和 style.css.map
    有多的說明你監控的方式錯了
img 
    放圖片的地方

js
    換到 vite 開發的時候可能會有變動

sass
    base: 基本元素
        color: 顏色
            使用->  color: map-get($colors, $pink-0);
        reset: reset.css
        spacing: padding, margin (可能會刪掉)
        typography: 字體字型
        var: 存放其他變數

    component: 元件
        btn: 按紐元件
        dropdown: 下拉選單

    layout: 每一頁都會有的元素
        footer
        header
    
    mixin: 
        mixin 是一種用來重複使用樣式的工具。它讓你可以定義一段可重用的 CSS 邏輯，然後在需要的地方呼叫(@include)這段邏輯，而不用每次都重新寫相同的程式碼。

        使用->

    page:
        每一頁專用的 css

    style.scss:
        把以上所有元素都匯入(@import)進 style.scss


.gitignore
    讓 git 忽略掉下面的開發，就不會上傳
    -> 每個人的各自開發的頁面 css (sass/page 裡面的 scss)內容一定不一樣，css檔案上傳的話一定會有衝突，所以要忽略掉，自己的css應該都要是等別人上傳並拉下來之後，透過監控自己的 style.scss 去產出自己的 style.css 檔
    目前有下面這些 (換到 vite 開發的時候可能會有變動)

    CSS
    css
    .vscode

head.html
    Html 初始模板，開發網頁前從這個複製