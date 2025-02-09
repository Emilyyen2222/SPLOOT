<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
    <!-- <main class="bg-purple-1" style="z-index: -10;"> -->
    <!------------------------match question 1---------------------->
<div v-if="question==1" class="matchWrap firstBox">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的毛孩朋友是</h4>
        <div class="image">
            <RouterLink to="/match/matchCard" style="cursor: pointer;">
                <div class="imgFlex">
                <img class="img2" src="@/assets/img/match/match1.svg" alt="">
                </div>
            </RouterLink>    
        </div>
    </div>
    <div class="options">
        <Btn v-for="option in matchPet.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchPet.selected, option)}"
        @click="matchPet.formChoice(matchPet.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(matchPet.selected.value.length != 0 )">下一題</Btn>
    </div>
    <!-- progress bar -->
    <ProgressBar :total="4" :current="1" ></ProgressBar>
    <div class="btnContainer">
        <Btn class="" btnStyle="baseline default">直接配對</Btn>
    </div>
</div>

   <!------------------------match question2貓---------------------->
<div v-if="question==2" class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的貓咪朋友是</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/match/match2-1.svg" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchCat.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchCat.selected, option)}"
        @click="matchCat.formChoice(matchCat.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(matchCat.selected.value.length != 0)">下一題</Btn>
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>
    </div>
</div>
   <!------------------------match question3狗---------------------->
<div v-if="question==3" class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的狗狗朋友是</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/match/match2-2.svg" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchDog.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchDog.selected, option)}"
        @click="matchDog.formChoice(matchDog.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(matchDog.selected.value.length != 0)">下一題</Btn>
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>
    </div>
</div>
   <!------------------------match question4---------------------->
<div v-if="question==4" class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我喜歡哪一種社交性</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/match/match3.svg" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchSocial.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchSocial.selected, option)}"
        @click="matchSocial.formChoice(matchSocial.selected, option)">{{ option }}</Btn>
        <Btn btnType="form" btnStyle="nextQ"
        @click="nextQuestion(matchSocial.selected.value.length != 0)">下一題</Btn>
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>
    </div>
</div>
   <!------------------------match question5---------------------->
<div v-if="question==5" class="matchWrap">
    <div class="questionContainer">
        <h4 class="title bold">我希望的毛孩朋友結紮狀態</h4>
        <div class="image">
            <div class="imgFlex">
                <img class="img1" src="@/assets/img/match/match4.svg" alt="">
            </div>
        </div>
    </div>
    <div v-show="true" class="options">
        <Btn v-for="option in matchNeutered.options" :key="option"
        btnType="form" btnStyle="option" 
        :class="{'-active': optionSelected(matchNeutered.selected, option)}"
        @click="matchNeutered.formChoice(matchNeutered.selected, option)">{{ option }}</Btn>
        <RouterLink to="/match/matchCard">
            <Btn btnType="form" btnStyle="nextQ">完成</Btn>
        </RouterLink>
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>
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


    const question = ref(1);


    // 下一題按鈕
    function nextQuestion(bol = false) {
    if (bol == true) {
        question.value++;
    } else {
        alert("請輸入選項");
    }
    }
    function lastQuestion(){
        question.value--;
    }

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