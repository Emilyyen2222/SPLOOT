<template>
  <BackendHeader active="訂單管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <div class="container">
        <h6>訂單管理</h6>
        <div class="pending">
          <input type="checkbox" id="pending" v-model="isPending" @change="dataFilter">
          <label for="pending">尚未寄出</label>
        </div>
      </div>
      <div class="searchBar">
        <InputText
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
        <th>訂單 ID</th>
        <th>會員 ID</th>
        <th>寵物盒訂閱 ID</th>
        <th>訂閱方案</th>
        <th>應寄出日</th>
        <th>會員取貨方式</th>
        <th>寄出狀態</th>
        <th>寄出物流</th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="data in viewData" :key="data.orderId">
          <td>{{ data.orderId }}</td>
          <td>{{ data.memberId }}</td>
          <td>{{ data.boxId }}</td>
          <td>{{ data.planName }}</td>
          <td>{{ data.shipmentDate }}</td>
          <td>{{ data.pickupMethod }}</td>
          <td>{{ data.shipmentStatus }}</td>
          <td>{{ data.shippingCarrier }}</td>
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

  const orders = ref(
    Array.from({length:103},(value,x) => ({
      orderId: `${x+1}`.padStart(4,'0'),
      memberId: `${x+1}`.padStart(4,'0'), 
      boxId:`${x+1}`.padStart(4,'0'), 
      planName: '銀卡(十二個月)', 
      shipmentDate: '2025-03-01', 
      pickupMethod: '全家取貨', 
      shipmentStatus: x % 3 === 0 ? '未寄出' : '已寄出',
      shippingCarrier: x % 2 ===0 || x % 5 === 0 ? '黑貓' : '店到店'
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
    } = useBackend(orders, 'orderId', 'shipmentStatus', '未寄出');

</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>