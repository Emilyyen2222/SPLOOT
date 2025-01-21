<template>
    <MainHeader theme="red" bgc=""></MainHeader>
    <!-- <main class="bg-purple-1" style="z-index: -10;"> -->
    <!------------------------match question 1---------------------->
<div class="cardWrap">
    <!-- 卡片部分 -->
    <div class="cardwrapper">
    <!-- 左側圖片區 -->
    <div class="imageContainer">
        <img src="@/assets/img/home/matchCard.svg" alt="">
    </div>
    <!-- 右側內容區 -->
    <div class="content">
        <div class="topSection">
        <div class="dot">
            <div class="dotActive"></div>
            <div class="dotInactive"></div>
            <div class="dotInactive"></div>
        </div>
        <div class="number">01</div>
        </div>
        <!-- 名稱與距離 -->
        <div class="info">
            <h4 class="name">COCO</h4>
            <div class="distance">
            <div class="smallText distanceIcon"></div>
            距離你6公里
            </div>
        </div>
        <!-- 標籤區 -->
        <div class="tags">
        <span class="xsText tag">邊境牧羊</span>
        <span class="xsText tag">活潑外向</span>
        <span class="xsText tag">愛玩球</span>
        <span class="xsText tag">台北市</span>
        <span class="xsText tag">松山區</span>
        <span class="xsText tag">大型犬</span>
        <span class="xsText tag">已結紮</span>
        </div>
        <!-- 內文 -->
        <p class="description bold">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur 
        </p>
    </div>
    </div>
    <div class="likeBtns">
        <Btn class="likeBtn" btnType="form" btnStyle="nextQ">喜歡</Btn> 
        <Btn class="likeBtn" btnType="form" btnStyle="nextQ">不喜歡</Btn> 
    </div>
</div>
<div class="preferenceBox">
    <div class="preferenceBtns">
        <img src="@/assets/img/icon/rightArrow.svg">
        <div class="preBox">
        <Btn class="preferenceBtn" btnStyle="baseline small">更改喜好</Btn>
        <Btn class="preferenceBtn" btnStyle="outline small">鍵盤</Btn>
        </div>
    </div>
</div>
<!-- 遮罩部分 -->
 <div class="overlay">
    <div class="cardSlots">
        <div class="cardContainer">
            <div class="petImage">
                <img src="@/assets/img/splootbox/dog1.avif" alt="">
            </div>
            <div class="dot">
                <div class="dotActive"></div>
                <div class="dotInactive"></div>
                <div class="dotInactive"></div>
            </div>
        </div>

        <div class="cardContainer">
            <div class="petImage">
                <img src="@/assets/img/splootbox/dog1.avif" alt="">
            </div>
            <div class="dot">
                <div class="dotActive"></div>
                <div class="dotInactive"></div>
                <div class="dotInactive"></div>
            </div>
        </div>

        <div class="cardContainer">
            <div class="petImage">
                <img src="@/assets/img/splootbox/dog1.avif" alt="">
            </div>
            <div class="dot">
                <div class="dotActive"></div>
                <div class="dotInactive"></div>
                <div class="dotInactive"></div>
            </div>
        </div>

        <div class="cardContainer">
            <div class="petImage">
                <img src="@/assets/img/splootbox/dog1.avif" alt="">
            </div>
            <div class="dot">
                <div class="dotActive"></div>
                <div class="dotInactive"></div>
                <div class="dotInactive"></div>
            </div>
        </div>
    </div>
</div>


    <!-- circle bg -->
        <div class="circleMatch"></div>
    <!-- </main> -->
    </template>
    
    <script setup>
        import MainHeader from "../components/MainHeader.vue";
        import DropdownMenu from "../components/DropdownMenu.vue";
        import Btn from '../components/Btn.vue';
        import InputText from '../components/InputText.vue';
        import { ref } from 'vue';



    
    </script>
    
    