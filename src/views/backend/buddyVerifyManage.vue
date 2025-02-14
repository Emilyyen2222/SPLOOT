<template>
  <BackendHeader active="小幫手身份審核" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>小幫手身份審核</h6>
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
        <th>會員 ID</th>
        <th>真實姓名</th>
        <th>身份審核</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="member in viewData" :key="member.memberId">
          <td>{{ member.memberId }}</td>
          <td>{{ member.memberName }}</td>
          <td>{{ member.email }}</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
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
  import {computed, ref} from "vue";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";

  const inputValue = ref("");
  
  const members = ref(
    Array.from({length:103},(value,x) => ({
      memberId: `${x+1}`.padStart(4,'0'), 
      memberName: `易烊千璽${x+1}`,
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