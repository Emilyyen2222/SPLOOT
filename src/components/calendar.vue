<template>

      <VCalendar 
      :title-position="calendarStyle"
      :attributes="attributes"
      locale="en"
      :masks="{ title: ' YYYY MMM',  weekdays: 'WWW' }"
      @dayclick="selectDate"
      />
      
    </template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

const selectedDate = ref(null);

const attributes = ref([
  {
    key: 'weekend',
    content: {
      class: 'blueDate'
    },
    dates: {
      repeat: {
        weekdays: [1,7], // 代表星期六日
      },
    },
  },
  {
    key: 'weekdays',
    content: {
      class: 'brownDate'
    },
    dates: {
      repeat: {
        weekdays: [2,3,4,5,6], // 代表星期一到五
      },
    },
  },
  {
    key: 'today',
    highlight: '',
    dates: new Date(),
  },
  {
    key: 'selected',
    highlight: {
      color: '',
      fillMode: 'solid',
    },
    dates: selectedDate,
  }
]);


const selectDate = (day) => {
  selectedDate.value = day.date; // 存儲被點擊的日期
};

//RWD設置

const calendarStyle = ref("");

const updateStyle =() => {
  if(window.innerWidth < 768){
    calendarStyle.value = "";
  }else{
    calendarStyle.value = "left";
  }
}

onMounted(()=>{
  updateStyle(); //初始化
  window.addEventListener("resize",updateStyle);
});

onBeforeUnmount(()=>{
  window.removeEventListener("resize",updateStyle);
});



</script>