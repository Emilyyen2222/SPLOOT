<template>
  <BackendHeader active="小幫手身份審核" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <div class="container">
        <h6>小幫手身份審核</h6>
        <div class="pending">
          <input type="checkbox" id="pending" v-model="isPending" @change="dataFilter">
          <label for="pending">待審核</label>
        </div>
      </div>
      <div class="searchBar">
        <InputText
        @keyup.enter="dataFilter"
        size="small"
        textAlign="textLeft"
        placeHolder="以 ID 查詢"
        v-model="inputValue"
        ></InputText>
        <Btn btnStyle="primary default" @click="dataFilter">搜尋</Btn>
      </div>
    </div>

    <table>
      <thead>
        <th>會員 ID</th>
        <th>真實姓名</th>
        <th>身份審核</th>
        <th></th>
        
      </thead>
      <tbody>        
        <tr v-for="data in viewData" :key="data.memberId">
          <td>{{ data.memberId }}</td>
          <td>{{ data.realName }}</td>
          <td>{{ data.identityVerification }}</td>
          
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

  const buddyVerifications = ref(
    Array.from({length:103},(value,x) => ({
      memberId: `${x+1}`.padStart(4,'0'), 
      realName: `易烊千璽${x+1}`,
      identityVerification: x % 2 === 0 ? '待審核' : '已審核',
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
    } = useBackend(buddyVerifications, 'memberId', 'identityVerification', '待審核');    


</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>