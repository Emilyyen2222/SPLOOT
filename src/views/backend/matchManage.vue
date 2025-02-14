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
          <td>{{ member.matchId}}</td>
          <td>{{ member.memberId }}</td>
          <td>{{ member.memberName }}</td>
          <td>{{ member.petNumber }}</td>
          <td>{{ member.splootBoxSub }}</td>
          <td>{{ member.helperPost }}</td>
          <td>{{ member.accountStatues }}</td>
          <td>wait</td>
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
  import {computed, ref} from "vue";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";

  const inputValue = ref("");
  
  const members = ref(
    Array.from({length:666},(value,x) => ({
      matchId: `${x % 2 === 0 ? x + 2 : x}`.padStart(4, '0'),
      memberId: `${x + 1}`.padStart(4, '0'), 
      memberName: x % 2 == 0 ? `芙莉蓮${x + 1}` : `欣梅爾${x + 1}`,  //以下資料都還沒改
      email:`tibame${x+1}@tibame.com`, 
      petNumber: 4, 
      splootBoxSub: 3, 
      helperPost: 2, 
      accountStatues: '正常'
    }))
  );

  const filterData = ref([...members.value]);

  const currentPage = ref(1); //預設第一頁開始
  const perPage = ref(10); //每頁渲染幾筆

  const totalPages = computed(() => {  //總共幾頁
    return  Math.ceil(filterData.value.length/perPage.value);
  });

  const viewData = computed(() => {  //渲染幾筆
    const start = (currentPage.value - 1) * perPage.value;
    const end = start + perPage.value;
    return  filterData.value.slice(start, end);
  });

  const visiblePages = computed(() => {
    const visible = [];
    const total = totalPages.value;
    const current = currentPage.value;

    if(total <= 4){
      for(let i = 1; i<= total; i++){
        visible.push(i);
      }
    }else{
      if(current <= 3){
        visible.push(1,2,3,"・・・",total);
      }else if(current >= total -2){
        visible.push("・・・",total -2, total - 1, total)
      }else{
        visible.push("・・・",current - 1, current, current +1, "・・・",total);
      }
    }

    return visible;
  });


  // 分頁按鈕函式
  const prePage = () => {
    if(currentPage.value > 1){
      currentPage.value--;
    }
  };

  const nextPage = () => {
    if(currentPage.value < totalPages.value){
      currentPage.value++;
    }
  };

  const thisPage = (page) => {
    if(page >= 1 && page !== "・・・")
    currentPage.value = page;
  };

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