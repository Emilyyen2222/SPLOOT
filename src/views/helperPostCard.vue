<template>
    <li class="helperPostCard" v-for="(card,index) in cardsData" :key="index">
        <div class="cardBox">
            <img :src="card.imgSrc" alt="" class="cardsImg" style="width: 100%;">
            <div class="cardText">
                <h6 class="cardsTitle bold">{{ card.title }}</h6>
                <div class="reviews">
                    <ul class="stars">
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star1"></li>
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star2"></li>
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star3"></li>
                        <li><img src="@/assets/img/icon/star-full.svg" alt="star" class="star star4"></li>
                        <li><img src="@/assets/img/icon/star-line.svg" alt="star" class="star star5"></li>
                    </ul>
                    <div class="avgGrade smallText">4.5</div>
                    <div class="commentCount smallText">(3)</div>
                </div>
                <div class="serviceTime smallText">服務時段：{{ card.serviceDaysStart }}至{{ card.serviceDaysEnd }} {{ card.serviceTimeStart }}-{{ card.serviceTimeEnd }}</div>                
            </div>
        </div>
    </li>
</template>

<script setup>
import { ref } from 'vue';

import Btn from '@/components/Btn.vue';

// 小幫手文章的card 的資料
const cardsData = ref([
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },/*
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        }, 
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },
        {
            imgSrc: new URL("@/assets/img/pet-friendly/democat.jpeg",  import.meta.url).href,
            title: "快速散步去",
            serviceDaysStart:"週一",
            serviceDaysEnd:"週五",
            serviceTimeStart: "09:00",
            serviceTimeEnd: "18:00",
        },*/
    ])

</script>
