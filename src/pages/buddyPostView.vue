<template>
<MainHeader theme="blue" bgc="blueberry-0"></MainHeader>
<!-- 主內容 -->
 <div class="wrapper">
<!-- 主要功能 -->
 <div class="buddyPost">
    <div class="nav">
        <div class="return">
            <Btn btnStyle="baseline small">返回</Btn>
        </div>
        <ul class="navTag">
            <li class="navTags"><Btn btnStyle="primary small">散步陪伴</Btn></li>
            <li class="navTags"><Btn btnStyle="primary small">到府照顧</Btn></li>
            <li class="navTags"><Btn btnStyle="primary small">友善寄宿</Btn></li>
            <li class="navTags"><Btn btnStyle="primary small">寵物計程車</Btn></li>
        </ul>
    </div>
 </div>
  
















 </div>
<MainFooter></MainFooter>
</template>

<script setup>
import {ref} from "vue";

import MainHeader from "@/components/MainHeader.vue";
import Btn from '@/components/Btn.vue';
import MainFooter from "@/components/MainFooter.vue"
</script>