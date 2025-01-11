<template>
    <banner></banner>

    <!-- circle bg -->
    <div class="circle"></div>

    <!-- question -->
    <div class="question_container">
        <div class="title">您的毛孩是哪種體型？</div>
        <div class="options">
            <div class="option">小型犬</div>
            <div class="option">中型犬</div>
            <div class="option">大型犬</div>
        </div>
        <div class="navigation">
            <div class="next-button">下一題</div>
            <div class="prev">
                <div class="prev-text">上一題</div>
                <div class="prev-line"></div>
            </div>
        </div>
    </div>
      <!-- progress bar -->
    <div class="progress-bar-container">
        <div class="progress-bar">
            <div class="progress-segment filled"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
            <div class="progress-segment"></div>
        </div>
    </div>
    
</template>

<script setup>
    import Banner from "../components/Banner.vue";
</script>

<style lang="scss" scoped>

</style>