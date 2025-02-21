<template>
  <BackendHeader active="活動管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <div class="container">
        <h6>活動管理</h6>
        <div class="add">
          <Btn btnStyle="outline small">＋ 新增</Btn>
        </div>
      </div>
      <div class="searchBar">
        <InputText
        @keyup.enter="dataFilter"
        size="small"
        textAlign="textLeft"
        placeHolder="以 活動名稱 查詢"
        v-model="inputValue"
        ></InputText>
        <Btn btnStyle="primary default" @click="dataFilter">搜尋</Btn>
      </div>
    </div>

    <table>
      <thead>
        <th>活動 ID</th>
        <th>日期</th>
        <th>時間</th>
        <th>活動名稱</th>
        <th>發起人</th>
        <th>參與人數</th>
        <th>活動狀態</th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="data in viewData" :key="data.eventId">
          <td>{{ data.eventId }}</td>
          <td>{{ data.date }}</td>
          <td>{{ data.time }}</td>
          <td>{{ data.eventName }}</td>
          <td>{{ data.organizer }}</td>
          <td>{{ data.peopleCount }}</td>
          <td>{{ data.eventStatus }}</td>
          <td><Btn btnStyle="outline small">查看與編輯</Btn></td>
        </tr>
      </tbody>
    </table>

    <div class="pagesContainer">
      <div class="pageBtn preBtn">
        <Btn btnStyle="small primary" @click="prePage"><</Btn>      
      </div>
      <div class="pageBtn" 
      v-for="page in visiblePages" 
      :key="page">
        <Btn :btnStyle="['selctedPage','small',{primary:currentPage !== page},{outline:currentPage === page},{text: page === '・・・'}]"
        @click="thisPage(page)">
          {{ page }}
        </Btn>      
      </div>
      <div class="pageBtn nextBtn">
        <Btn btnStyle="small primary" @click="nextPage">></Btn>      
      </div>
    </div>
  </div>

</template>

<script setup>
  import {ref} from "vue";
  import {useBackend} from "@/utils/backendUtils"
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";

  const events = ref(
    Array.from({length:77},(value,x) => ({
      eventId: `${x+1}`.padStart(4,'0'), 
      date: x === 0 ? '2025-02-18' : '2025-01-20',
      time: x === 0 ? '13:30 - 16:30' : '10:00 - 16:35', 
      eventName: x === 0 ? 'SPLOOT創立剪綵會' : `紅蓮的弓矢${x}`, 
      organizer: x === 0 ? '官方活動' : `尼多力諾${x}`, 
      peopleCount: x === 0 ? 999 : 20, 
      eventStatus: x % 9 === 0 && x !== 0 ? '暫停舉行' : '正常舉行',
    }))
  );

  const {
        filterData,
        currentPage,
        perPage,
        totalPages,
        viewData,
        visiblePages,
        prePage,
        nextPage,
        thisPage,
        isPending, //審核專用
        inputValue,
        dataFilter,
    } = useBackend(events, 'eventName');    
  
</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>