<template>
  <BackendHeader active="寵物照片審核" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <div class="container">
        <h6>寵物照片審核</h6>
        <div class="pending">
          <input type="checkbox" id="pending" v-model="isPending" @change="dataFilter">
          <label for="pending">待審核</label>
        </div>
      </div>
      <div class="searchBar">
        <InputText
        size="small"
        textAlign="textLeft"
        placeHolder="以 ID,姓名,電子信箱 查詢"
        v-model="inputValue"
        ></InputText>
        <Btn btnStyle="primary default" @click="dataFilter">搜尋</Btn>
      </div>
    </div>

    <table>
      <thead>
        <th>會員 ID</th>
        <th>品種</th>
        <th>年齡</th>
        <th>照片審核</th>
        <th>創建時間</th>
        <th>寵物照片</th>
      </thead>
      <tbody>        
        <tr v-for="member in viewData" :key="member.memberId">
          <td class="forImg">{{ member.memberId }}</td>
          <td class="forImg">{{ member.breed }}</td>
          <td class="forImg">{{ member.age }}</td>
          <td class="forImg dropdown">
            <DropdownMenu class="dropdownInput"
              :placeHolder="member.photoReview"
              :options="photoReview"
              v-model="reviewStatus">
            </DropdownMenu>
          </td>
          <td class="forImg">{{ member.creationTime }}</td>
          <td class="imgTd">
            <img :src="member.petPhoto" alt="petPhoto">
          </td>
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
  import DropdownMenu from "../../components/DropdownMenu.vue"

  const cardVerifications = ref(
    Array.from({length:103},(value,x) => ({
      memberId: `${x+1}`.padStart(4,'0'), 
      breed: `奧米加咆哮獸${x+1}`,
      age: 66, 
      photoReview: x%3 === 0 ? '待審核' : '已審核', 
      creationTime: '2025-02-14', 
      petPhoto: new URL("@/assets/img/pet-friendly/democat.jpeg", import.meta.url).href, 
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
    } = useBackend(cardVerifications);  

    const photoReview =ref([
      {name:'已審核'},
      {name:'未通過'},
    ]);

    // 審核雙向綁定
    const reviewStatus = ref('');

    // 待審核checkbox boolean值
    const isPending = ref(false);

    // 搜尋框輸入資料
    const inputValue =ref(""); 


  //搜尋＋審核篩選
  const dataFilter = () => {
    let result = cardVerifications.value;

    const searchId = inputValue.value.trim();

    //篩選會員id
    if(searchId !== ""){
      result = result.filter((data) => {
        return  String(data.memberId).includes(searchId)
      });
    }
    //審核按鈕是否被勾選
    if(isPending.value){
      result = result.filter((data) => {
        return  data.photoReview === '待審核'
      });
    }
    //更新過濾資料
    filterData.value = [...result];
    currentPage.value = 1;

  };

</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>