<template>

      <VCalendar 
      :title-position="calendarStyle"
      @dayclick="handleDayClick"
      :attributes="attributes"
      locale="en"
      :masks="{ title: ' YYYY MMM',  weekdays: 'WWW' }"
      
      />
      
    </template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

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
  }
]);

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


//日曆點選

const handleDayClick =(day) => {

  const selectdate = day.date;
  alert(selectdate);
}


</script>