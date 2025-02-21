<template>
  <BackendHeader active="配對管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>配對管理</h6>
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
        <tr v-for="(match, index) in viewData" :key="index">
          <td>{{ match.match_id }}</td>
          <td>{{ match.user_id }}</td>
          <td>{{ match.userName }}</td>
          <td>{{ match.matcher_id }}</td>
          <td>{{ match.matcherName }}</td>
          <td>{{ match.match_choice }}</td>
          <td>{{ match.match_status }}</td>
          <td>{{ new Date(match.created_date).toISOString().split('T')[0] }}</td>
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
  import {ref, onBeforeMount} from "vue";
  import {useBackend} from "@/utils/backendUtils";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";

  const matchs = ref(
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

  const matches = ref([]);

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
    } = useBackend(matches, 'match_id'); 

  async function findAllMatchesPhp() {
    const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/backend/findAllMatches.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    try{
      const matchInfo = await resp.json();
        if(matchInfo.status == 'success'){
          const matchData = matchInfo.data;
          matches.value = matchData;
        }
    } catch (error){
      console.error('Error parsing JSON:', error);
    }
  }

  onBeforeMount(() => {
    findAllMatchesPhp();
  })
</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>