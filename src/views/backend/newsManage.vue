<template>
  <BackendHeader active="消息管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>消息管理</h6>
      <div class="searchBar">
        <InputText
        size="small"
        textAlign="textLeft"
        placeHolder="以 ID,姓名,電子信箱 查詢"
        v-model="inputValue"
        ></InputText>
        <Btn btnStyle="primary default" @click="isSearchId">搜尋</Btn>
      </div>
    </div>

    <table>
      <thead>
        <th>消息 ID</th>
        <th>分類</th>
        <th>名稱</th>
        <th>作者</th>
        <th>發布位置</th>
        <th>上稿日期</th>
        <th>上稿時間</th>
        <th>消息狀態</th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="member in viewData" :key="member.memberId">
          <td>{{ member.memberId }}</td>
          <td>{{ member.memberName }}</td>
          <td>{{ member.email }}</td>
          <td>{{ member.petNumber }}</td>
          <td>{{ member.splootBoxSub }}</td>
          <td>{{ member.helperPost }}</td>
          <td>{{ member.accountStatues }}</td>
          <td>{{ member.accountStatues }}</td>
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

  const members = ref(
    Array.from({length:103},(value,x) => ({
      memberId: `${x+1}`.padStart(4,'0'), 
      memberName: `海綿寶寶${x+1}`,
      email:`tibame${x+1}@tibame.com`, 
      petNumber: 4, 
      splootBoxSub: 3, 
      helperPost: 2, 
      accountStatues: '正常'
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
        thisPage
    } = useBackend(members);  

    // 搜尋框輸入資料
    const inputValue =ref(""); 
  
  // 搜尋
  const isSearchId = () => {
    const searchId = inputValue.value.trim();

    if(searchId === ""){
      filterData.value = [...members.value];
    }else{
      filterData.value = members.value.filter(data =>
        String(data.memberId).includes(searchId) ||
        data.memberName.includes(searchId) ||
        data.email.includes(searchId)
      );
    }
    currentPage.value = 1;
  };

</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>