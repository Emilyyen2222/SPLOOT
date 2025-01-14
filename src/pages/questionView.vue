<template>
<MainHeader theme="red" bgc=""></MainHeader>

<!------------------------ question 1---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩叫什麼名字？</h4>
        <div class="options">
            <!-- <p class="option first">毛孩姓名</p> -->
            <div class="first">
            <InputText placeHolder="毛孩姓名" errorMsg="Invalid Input" v-model="inputValue" :hasError="inputError">
            </InputText>
            </div>
            <Btn btnStyle="white default">女生 狗狗</Btn>
            <Btn btnStyle="white default">男生 狗狗</Btn>
            <Btn btnStyle="white default">女生 貓貓</Btn>
            <Btn btnStyle="white default">男生 貓貓</Btn>
        </div>
        <Btn btnType="form" btnStyle="nextQ">下一題</Btn>    
    </div>

     <!-- progress bar -->
     <div class="progressBarContainer">
        <div class="progressBar">
            <div class="progressSegment filled"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
            <div class="progressSegment"></div>
        </div>
    </div>
</div>
<!------------------------ question 2貓---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <!-- <p class="option first">毛孩姓名</p> -->
            <div class="questionBox"><div class="btn option"><span>幼貓</span></div></div>
            <div class="questionBox"><div class="btn option"><span>成貓</span></div></div>
            <!-- <p class="option">幼貓</p>
            <p class="option">成貓</p> -->
        </div>
            <div class="questionBox"><div class="btn nextQ"><span>下一題</span></div></div>
            <div class="questionBox"><div class="btn lastQ"><span>上一題</span></div></div>

        <!-- <div class="navigation">
            <p class="nextButton">下一題</p>
            <div class="prev">
                <p class="prevText">上一題</p>
                <div class="prevLine"></div>
            </div>
        </div> -->
    </div>
</div>
<!------------------------ question 2狗---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <!-- <p class="option first">毛孩姓名</p> -->
            <div class="questionBox"><div class="btn option"><span>小型犬</span></div></div>
            <div class="questionBox"><div class="btn option"><span>中型犬</span></div></div>
            <div class="questionBox"><div class="btn option"><span>大型犬</span></div></div>
            <!-- <p class="option">小型犬</p>
            <p class="option">中型犬</p>
            <p class="option">大型犬</p> -->
        </div>
        <div class="questionBox"><div class="btn nextQ"><span>下一題</span></div></div>
        <div class="questionBox"><div class="btn lastQ"><span>上一題</span></div></div>
        <!-- <div class="navigation">
            <p class="nextButton">下一題</p>
            <div class="prev">
                <p class="prevText">上一題</p>
                <div class="prevLine"></div>
            </div>
        </div> -->
    </div>
</div>
<!------------------------ question 3---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是什麼品種？</h4>
        <div class="options">
            <!-- <p class="option first">我的毛孩品種是</p> -->
            <DropdownMenu :placeHolder="menu1.placeHolder" :options="menu1.options"></DropdownMenu>
        </div>
        <div class="navigation">
            <p class="nextButton">下一題</p>
            <div class="prev">
                <p class="prevText">上一題</p>
                <div class="prevLine"></div>
            </div>
        </div>
    </div>
</div>
<!------------------------ question 4---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩生日是？</h4>
        <div class="options date">
            <div class="smallText">領養的日期也可以喔！
                我們希望可以幫您的毛孩一起慶祝這特別的日子！</div>
                <DropdownMenu :placeHolder="menu1.placeHolder" :options="menu1.options"></DropdownMenu>
                <DropdownMenu :placeHolder="menu1.placeHolder" :options="menu1.options"></DropdownMenu>
                <DropdownMenu :placeHolder="menu1.placeHolder" :options="menu1.options"></DropdownMenu>
        </div>
        <div class="navigation">
            <p class="nextButton">下一題</p>
            <div class="prev">
                <p class="prevText">上一題</p>
                <div class="prevLine"></div>
            </div>
        </div>
    </div>
</div>
   
    
    <!-- circle bg -->
    <div class="circleQuestion"></div>
</template>

<script setup>
    import MainHeader from "../components/MainHeader.vue";
    import DropdownMenu from "../components/DropdownMenu.vue";
    import Btn from '../components/Btn.vue';
    import InputText from '../components/InputText.vue';

    const menu1 = {
    placeHolder: '我的毛孩品種是',
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
</script>

