<template>
  <BackendHeader active="寵物盒方案管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>寵物盒方案管理</h6>
    </div>

    <table>
      <thead>
        <th>方案</th>
        <th>週期</th>
        <th>每月價錢</th>
        <th>訂閱人數</th>
        <th>內容</th>
        <th>最後更新</th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="(data, index) in plans" :key="data.planName">
          <td>{{ data.planName }}</td>
          <td>{{ data.planCycle }}</td>
          <td>{{ data.planPrice }}</td>
          <td>{{ data.Subscribers }}</td>
          <td>{{ data.content }}</td>
          <td>{{ data.lastUpdate }}</td>
          <td><Btn btnStyle="outline small" @click="popUpToggle(index)">查看與編輯</Btn></td>
        </tr>
      </tbody>
    </table>

    <!-- <div class="pagesContainer">
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
    </div> -->
  </div>

  <PopUp
  :is-pop-up="isPopUp"
  >
  <div class="setPopUpContainer">
    <div class="content">
      <div class="leftContent">
        <div class="leftItem">
          <p class="item">方案：</p>
          <p class="item">每月價錢：</p>
          <p class="item">大型犬內容：</p>
          <p class="item">中型犬內容：</p>
          <p class="item">小型犬內容：</p>
        </div>
        <div class="rightItem">
          <p class="item">{{ thisData.planName }} - {{ thisData.planCycle }}</p>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="priceInputValue"
          ></InputText>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="LargeInputValue"
          ></InputText>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="middleInputValue"
          ></InputText>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="smallInputValue"
          ></InputText>
        </div>
      </div>
      <div class="rightContent">
        <div class="leftItem">
          <p class="item">訂閱人數：</p>
          <p class="item">更新者：</p>
          <p class="item">最後更新：</p>
        </div>
        <div class="rightItem">
          <p class="item">99</p>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="updaterInputValue"
          ></InputText>
          <p class="item">2025-2-14</p>
        </div>
      </div>
    </div>
    <div class="popBtnBox">
      <Btn btnStyle="primary small" @click="popUpToggle">儲存</Btn>
      <Btn btnStyle="outline small" @click="popUpToggle">關閉</Btn>
    </div>
  </div>

  </PopUp>

</template>

<script setup>
  import {computed, ref} from "vue";
  import {useBackend} from "@/utils/backendUtils";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";
  import PopUp from "@/components/PopUp.vue";


  const plans = ref([
    // 銀卡
    { planName: "銀卡", planCycle: "3個月", planPrice: 799, Subscribers: 100, content: "玩具 2 個, 零食 2 包", lastUpdate: "2025-2-28" },
    { planName: "銀卡", planCycle: "6個月", planPrice: 799, Subscribers: 100, content: "玩具 2 個, 零食 2 包", lastUpdate: "2025-2-28" },
    { planName: "銀卡", planCycle: "12個月", planPrice: 799, Subscribers: 100, content: "玩具 2 個, 零食 2 包", lastUpdate: "2025-2-28" },

    // 金卡
    { planName: "金卡", planCycle: "3個月", planPrice: 999, Subscribers: 100, content: "玩具 2 個, 零食 5 包", lastUpdate: "2025-2-28" },
    { planName: "金卡", planCycle: "6個月", planPrice: 999, Subscribers: 100, content: "玩具 2 個, 零食 5 包", lastUpdate: "2025-2-28" },
    { planName: "金卡", planCycle: "12個月", planPrice: 999, Subscribers: 100, content: "玩具 2 個, 零食 5 包", lastUpdate: "2025-2-28" },

    // 白金卡
    { planName: "白金卡", planCycle: "3個月", planPrice: 1299, Subscribers: 100, content: "玩具 5 個, 零食 7 包", lastUpdate: "2025-2-28" },
    { planName: "白金卡", planCycle: "6個月", planPrice: 1299, Subscribers: 100, content: "玩具 5 個, 零食 7 包", lastUpdate: "2025-2-28" },
    { planName: "白金卡", planCycle: "12個月", planPrice: 1299, Subscribers: 100, content: "玩具 5 個, 零食 7 包", lastUpdate: "2025-2-28" },
  ]);

  // v-modle
  const priceInputValue = computed(() => {
    return thisData.value ? thisData.value.planPrice : "";
  });
  const LargeInputValue = computed(() => {
    return thisData.value ? thisData.value.content : "";
  });
  const middleInputValue = computed(() => {
    return thisData.value ? thisData.value.content : "";
  });
  const smallInputValue = computed(() => {
    return thisData.value ? thisData.value.content : "";
  });

  const updaterInputValue = ref("NightMonkey");



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
        isPopUp,
        thisData,
        popUpToggle,
  } = useBackend(plans); 


</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>