<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
    <!-- <main class="bg-purple-1" style="z-index: -10;"> -->
    <!------------------------match question 1---------------------->
<div class="matchWrap firstBox">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的毛孩朋友是</h4>
        <div class="image">
            <div class="imgFlex">
            <img class="img2" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn btnType="form" btnStyle="option">貓貓</Btn>
        <Btn btnType="form" btnStyle="option">狗狗</Btn>
        <Btn btnType="form" btnStyle="option">不限</Btn>
    </div>
    <!-- progress bar -->
    <div class="progressBarContainer">
        <div class="btnContainer">
            <Btn class="" btnStyle="baseline default">直接配對</Btn>
        </div>
        <div class="progressBar">
            <div class="progressSegment filled"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
        </div>
    </div>
</div>
   <!------------------------match question2貓---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的貓咪朋友是</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div>
            <div class="imgFlex">
                <img class="img2" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div> 
            <div class="imgFlex">
                <img class="img3" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div> 
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn btnType="form" btnStyle="option">成貓</Btn>
        <Btn btnType="form" btnStyle="option">幼貓</Btn>
        <Btn btnType="form" btnStyle="option">品種貓</Btn>
        <Btn btnType="form" btnStyle="option">不限</Btn>
    </div>
</div>
   <!------------------------match question2狗---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的狗狗朋友是</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div>
            <div class="imgFlex">
                <img class="img2" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div> 
            <div class="imgFlex">
                <img class="img3" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div> 
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn btnType="form" btnStyle="option">小型犬</Btn>
        <Btn btnType="form" btnStyle="option">中型犬</Btn>
        <Btn btnType="form" btnStyle="option">大型犬</Btn>
        <Btn btnType="form" btnStyle="option">不限</Btn>
    </div>
</div>
   <!------------------------match question3---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我喜歡哪一種社交性</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn btnType="form" btnStyle="option">親貓親狗</Btn>
        <Btn btnType="form" btnStyle="option">親近同類 親人</Btn>
        <Btn btnType="form" btnStyle="option">不親近同類 親人</Btn>
        <Btn btnType="form" btnStyle="option">不限</Btn>
    </div>
</div>
   <!------------------------match question4---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我希望的毛孩朋友結紮狀態</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/dogbox.avif" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn btnType="form" btnStyle="option">已結紮</Btn>
        <Btn btnType="form" btnStyle="option">未結紮</Btn>
        <Btn btnType="form" btnStyle="option">不限</Btn>
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



    // v-if="currentQuestion === 1"
    // v-if="currentQuestion !== 4"
    // 追蹤當前問題
    const currentQuestion = ref(1);
    // 跳轉到下題
    setTimeout(() => {
        currentQuestion.value = 5;
    }, 3000); 
    </script>
    
<style lang="scss" scoped>
    header{
        &.bg-purple-1{
            background-color: transparent;
        }
    }

</style>