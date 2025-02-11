<template>
    <MainHeader theme="red" bgc="purple-1"></MainHeader>
<!------------------------match question 1---------------------->
<div v-if="question==1" class="matchWrap firstBox">
    <div class="questionContainer">
        <h4 class="title bold">我想認識的毛孩朋友是</h4>
        <div class="image">
            <!-- <RouterLink to="/match/matchCard" style="cursor: pointer;"> -->
                <div class="imgFlex">
                <img class="img2" src="@/assets/img/match/match1.svg" alt="">
                </div>
            <!-- </RouterLink>     -->
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
        @click="lastQuestion"
        >上一題</Btn>
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
            <Btn btnType="form" btnStyle="nextQ">開始配對</Btn>
        </RouterLink>
        <Btn btnType="form" btnStyle="lastQ"
        @click="lastQuestion">上一題</Btn>
    </div>
</div>
    <!-- progress bar -->
    <ProgressBar :total="4" :current="progress" ></ProgressBar>
    <!-- circle bg -->
        <div class="circleMatch"></div>
    <!-- 直接配對 -->
    <div class="btnContainer">
        <RouterLink to="/match/matchCard">
            <Btn class="" btnStyle="baseline default" v-if="goMatch">直接配對</Btn>
        </RouterLink>
    </div>

</template>
    
<script setup>
    import {ref, watch} from "vue";
    import MainHeader from "../components/MainHeader.vue";
    import Btn from '../components/Btn.vue';
    import ProgressBar from "../components/ProgressBar.vue";


    const question = ref(1);
    const progress = ref(1);
    const goMatch  = ref(true); //直接配對按鈕

    // 下一題/上一題按鈕
    function nextQuestion(bol = false) {
    if (bol == true) {

        if(question.value == 2 
        && matchPet.selected.value[0] == '貓貓'){
            question.value = 4;
            progress.value = 3;
            return;
        }
        if(question.value == 1 
        && matchPet.selected.value[0] == '狗狗'){
            question.value = 3;
            progress.value = 2;
            return;
        }
        if(question.value == 2 
        && matchPet.selected.value[0] == '不限'){
            question.value = 3;
            progress.value = 2;
            return;
        }
        question.value++;
        progress.value++;

        if (question.value == 5){
            goMatch.value = false;
        }
    } else {
        alert("請輸入選項");
    }
    }

    function lastQuestion(){
        if(question.value == 4 
        && matchPet.selected.value[0] == '貓貓'){
            question.value = 2;
            progress.value = 2;
            return;
        }
        if(question.value == 4 
        && matchPet.selected.value[0] == '狗狗'){
            question.value = 3;
            progress.value = 2;
            return;
        }
        if(question.value == 3 
        && matchPet.selected.value[0] == '狗狗'){
            question.value = 1;
            progress.value = 1;
            return;
        }
        if(question.value == 4 
        && matchPet.selected.value[0] == '不限'){
            question.value = 2;
            progress.value = 2;
            return;
        }
        question.value--;
        progress.value--;
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
    }
    const optionSelected = (selected, option) => {
        return selected.value.includes(option);
    }
    
    let matchq1;
    // question 1 監看是貓貓還是狗狗
    watch(matchPet.selected, (newValue, oldValue) => {
        if (matchPet.selected.value[0].includes('貓貓')) {
            matchq1 = matchCat;
        } else if(matchPet.selected.value[0].includes('狗狗')) {
            matchq1 = matchDog;
        }
    })

</script>