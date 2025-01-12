<template>
<Banner theme="red" bgc=""></Banner>

<!------------------------ question 1---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩叫什麼名字？</h4>
        <div class="options">
            <p class="option first">毛孩姓名</p>
            <p class="option">女生 狗狗</p>
            <p class="option">男生 狗狗</p>
            <p class="option">女生 貓貓</p>
            <p class="option">男生 貓貓</p>
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
<!------------------------ question 2貓---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <!-- <p class="option first">毛孩姓名</p> -->
            <p class="option">幼貓</p>
            <p class="option">成貓</p>
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
<!------------------------ question 2狗---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是哪種體型？</h4>
        <div class="options">
            <!-- <p class="option first">毛孩姓名</p> -->
            <p class="option">小型犬</p>
            <p class="option">中型犬</p>
            <p class="option">大型犬</p>
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
<!------------------------ question 3---------------------->
<div class="box">
    <div class="questionContainer">
        <h4 class="title bold">您的毛孩是什麼品種？</h4>
        <div class="options">
            <p class="option first">我的毛孩品種是</p>
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
        <div class="options">
            <div class="smallText">領養的日期也可以喔！
                我們希望可以幫您的毛孩一起慶祝這特別的日子！</div>
            <div class="birthday">
                <p class="option first year">年份</p>
                <p class="option first month">月份</p>
                <p class="option first date">日期</p>
            </div>
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
    
    <!-- circle bg -->
    <div class="circleQuestion"></div>
</template>

<script setup>
    import Banner from "../components/Banner.vue";
</script>

<style lang="scss" scoped>

</style>