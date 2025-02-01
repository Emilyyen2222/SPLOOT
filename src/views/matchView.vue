<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
    <!-- <main class="bg-purple-1" style="z-index: -10;"> -->
    <!------------------------match question 1---------------------->
<div class="matchWrap firstBox">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的毛孩朋友是</h4>
        <div class="image">
            <RouterLink to="/match/matchCard" style="cursor: pointer;">
                <div class="imgFlex">
                <img class="img2" src="@/assets/img/splootbox/dogbox.avif" alt="">
                </div>
            </RouterLink>    
        </div>
    </div>
    <div class="options">
        <!-- <RouterLink to="/match/petInfoCard" style="cursor: pointer;"> -->
            <!-- <Btn btnType="form" btnStyle="option">貓貓</Btn> -->
        <!-- </RouterLink
        <Btn btnType="form" btnStyle="option">狗狗</Btn> -->
        <!-- <Btn btnType="form" btnStyle="option">不限</Btn> -->
        <Btn v-for="option in matchPet.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchPet.selected, option)}"
        @click="matchPet.formChoice(matchPet.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn>
    </div>
    <!-- progress bar -->
    <ProgressBar :total="4" :current="1" ></ProgressBar>
    <div class="btnContainer">
        <Btn class="" btnStyle="baseline default">直接配對</Btn>
    </div>
</div>

   <!------------------------match question2貓---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的貓咪朋友是</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/cat1.jpg" alt="">
            </div>
            <div class="imgFlex">
                <img class="img2" src="@/assets/img/splootbox/cat2.jpg" alt="">
            </div> 
            <div class="imgFlex">
                <img class="img3" src="@/assets/img/splootbox/cat3.jpg" alt="">
            </div> 
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchCat.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchCat.selected, option)}"
        @click="matchCat.formChoice(matchCat.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn>
        <Btn btnType="form" btnStyle="lastQ">上一題</Btn>
    </div>
</div>
   <!------------------------match question2狗---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的狗狗朋友是</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/dog1.jpg" alt="">
            </div>
            <div class="imgFlex">
                <img class="img2" src="@/assets/img/splootbox/dog2.jpg" alt="">
            </div> 
            <div class="imgFlex">
                <img class="img3" src="@/assets/img/splootbox/dog3.jpg" alt="">
            </div> 
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchDog.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchDog.selected, option)}"
        @click="matchDog.formChoice(matchDog.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn>
        <Btn btnType="form" btnStyle="lastQ">上一題</Btn>
    </div>
</div>
   <!------------------------match question3---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我喜歡哪一種社交性</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/dog2.jpg" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchSocial.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchSocial.selected, option)}"
        @click="matchSocial.formChoice(matchSocial.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn>
        <Btn btnType="form" btnStyle="lastQ">上一題</Btn>
    </div>
</div>
   <!------------------------match question4---------------------->
<div class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我希望的毛孩朋友結紮狀態</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/splootbox/doghospital.avif" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchNeutered.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchNeutered.selected, option)}"
        @click="matchNeutered.formChoice(matchNeutered.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ">完成</Btn>
        <Btn btnType="form" btnStyle="lastQ">上一題</Btn>
    </div>
</div>
    <!-- circle bg -->
        <div class="circleMatch"></div>
    <!-- </main> -->
    
</template>
    
<script setup>
    import {ref} from "vue";
    import MainHeader from "../components/MainHeader.vue";
    import Btn from '../components/Btn.vue';
    import DropdownMenu from "../components/DropdownMenu.vue";
    import InputText from '../components/InputText.vue';
    import ProgressBar from "../components/ProgressBar.vue";

    const matchPet = {
        formChoice: singleChoice,
        options: ['貓貓', '狗狗', '不限'],
        selected: ref([]),
    };
    const matchCat = {
        formChoice: singleChoice,
        options: ['成貓', '幼貓', '品種貓', '不限'],
        selected: ref([]),
    };
    const matchDog = {
        formChoice: singleChoice,
        options: ['小型犬', '中型犬', '大型犬', '不限'],
        selected: ref([]),
    };
    const matchSocial = {
        formChoice: singleChoice,
        options: ['親貓親狗', '親近同類 親人', '不親近同類 親人', '不限'],
        selected: ref([]),
    };
    const matchNeutered = {
        formChoice: singleChoice,
        options: ['已結紮', '未結紮', '不限'],
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
    

</script>