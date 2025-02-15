<template>
  <BackendHeader active="配對管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>配對管理</h6>
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
        <th>配對 ID</th>
        <th>會員 ID</th>
        <th>會員姓名</th>
        <th>對象 ID</th>
        <th>對象姓名</th>
        <th>配對選擇</th>
        <th>配對狀態</th>
        <th>配對時間</th>
      </thead>
      <tbody>        
        <tr v-for="member in viewData" :key="member.memberId">
          <td>{{ member.memberId }}</td>
          <td>{{ member.memberId }}</td>
          <td>{{ member.memberName}}</td>
          <td>{{ member.matchedMemberID }}</td>
          <td>{{ member.matchedMemberName }}</td>
          <td>{{ member.matchSelected }}</td>
          <td>{{ member.matchStatus }}</td>
          <td>{{ member.matchTimes }}</td>
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

  const match = ref(
    Array.from({length:666},(value,x) => ({
      matchId: `${x + 1}`.padStart(4, '0'),
      memberId: `${x + 1}`.padStart(4, '0'), 
      memberName: x % 2 == 0 ? `芙莉蓮${x + 1}` : `欣梅爾${x + 1}`,
      matchedMemberID:`${x % 2 === 0 ? x + 2 : x}`.padStart(4, '0'),
      matchedMemberName: x % 2 == 0 ? `欣梅爾${x+2}` : `芙莉蓮${x}`,
      matchSelected: '喜歡(右滑)',
      matchStatus:'成功',
      matchTimes:'2025-01-01',      
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
    } = useBackend(match);  

    // 搜尋框輸入資料
    const inputValue =ref(""); 
  
  // 搜尋
  const isSearchId = () => {
    const searchId = inputValue.value.trim();

    if(searchId === ""){
      filterData.value = [...match.value];
    }else{
      filterData.value = match.value.filter(data =>
        String(data.memberId).includes(searchId) ||
        data.memberName.includes(searchId)
      );
    }
    currentPage.value = 1;
  };

</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>