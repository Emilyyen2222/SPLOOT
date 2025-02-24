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
        <tr v-for="(data, index) in viewData" :key="data.orderId">
          <td>{{ data.orderId }}</td>
          <td>{{ data.memberId }}</td>
          <td>{{ data.boxId }}</td>
          <td>{{ data.planName }}</td>
          <td>{{ data.mailDeadline }}</td>
          <td>{{ data.pickupMethod }}</td>
          <td>{{ data.shipmentStatus }}</td>
          <td>{{ data.shippingCarrier }}</td>
          <td><Btn btnStyle="outline small" @click="popUpToggle(index)">查看與編輯</Btn></td>
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

  <PopUp
  :is-pop-up="isPopUp"
  >
  <div class="setPopUpContainer">
    <div class="content">
      <div class="leftContent">
        <div class="leftItem orderItem">
          <p class="item">訂單 ID：</p>
          <p class="item">會員 ID：</p>
          <p class="item">寵物盒訂閱 ID：</p>
          <p class="item">訂閱方案：</p>
          <p class="item">會員取貨方式：</p>
        </div>
        <div class="rightItem orderItem">
          <p class="item">{{ thisData.orderId }}</p>
          <p class="item">{{ thisData.memberId }}</p>
          <p class="item">{{ thisData.boxId }}</p>
          <p class="item">{{ thisData.planName }}</p>
          <p class="item">{{ thisData.pickupMethod }}</p>          
        </div>
      </div>
      <div class="rightContent">
        <div class="leftItem orderItem">
          <p class="item">應寄出日：</p>
          <p class="item">寄出狀態：</p>
          <p class="item">實際寄出日：</p>
          <p class="item">寄出物流：</p>
          <p class="item">寄出者：</p>
          <p class="item">最後更新：</p>
        </div>
        <div class="rightItem">
          <p class="item">{{ thisData.mailDeadline }}</p>
          <DropdownMenu class="dropdownInput"
            :placeHolder="thisData.shipmentStatus"
            :options="shipmentStatusOption"
            v-model="shipmentInputValue"
            @change="">
          </DropdownMenu>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="realMailinputValue"
          ></InputText>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="carrierInputValue"
          ></InputText>
          <InputText
          size="small"
          textAlign="textLeft"
          placeHolder=""
          v-model="mailerInputValue"
          ></InputText>
          <p class="item">{{ thisData.lastUpdate }}</p>
        </div>
      </div>
    </div>
    <div class="popBtnBox">
      <Btn btnStyle="primary small" @click="updateOrderData">儲存</Btn>
      <Btn btnStyle="outline small" @click="popUpToggle">關閉</Btn>
    </div>
  </div>

  </PopUp>

</template>

<script setup>
  import {ref, watch} from "vue";
  import {useBackend} from "@/utils/backendUtils"
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";
  import PopUp from "@/components/PopUp.vue";
  import DropdownMenu from "@/components/DropdownMenu.vue"

  const orders = ref(
    Array.from({length:103},(value,x) => ({
      orderId: `${x+1}`.padStart(4,'0'),
      memberId: `${x+1}`.padStart(4,'0'), 
      boxId:`${x+1}`.padStart(4,'0'), 
      planName: '銀卡(十二個月)', 
      mailDeadline: "2025-03-05",
      pickupMethod: '全家取貨', 
      shipmentStatus: x % 3 === 0 ? '未寄出' : '已寄出',
      shippingCarrier: x % 2 ===0 || x % 5 === 0 ? '黑貓' : '店到店',
      realMailDate: "2025-02-22",
      mailer:"NightMonkey",
      lastUpdate: "2025-2-28"
    }))
  );

  const shipmentInputValue =ref("");
  const realMailinputValue = ref("");
  const carrierInputValue =ref("");
  const mailerInputValue =ref("");

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
    } = useBackend(orders, 'orderId', 'shipmentStatus', '未寄出');

    // 下拉式選單
    const shipmentStatusOption = ref([
      {name:"已寄出"},
      {name:"未寄出"}
    ]);

    watch(isPopUp, (newValue) => {
      if(newValue && thisData.value){
        shipmentInputValue.value = thisData.value.shipmentStatus;
        realMailinputValue.value = thisData.value.realMailDate;
        carrierInputValue.value = thisData.value.shippingCarrier;
        mailerInputValue.value = thisData.value.mailer;
      }
    });

    const updateOrderData = () => {
      if(!thisData.value || !shipmentInputValue.value || !realMailinputValue.value || !carrierInputValue.value || !mailerInputValue.value){
        alert("資料不完全");
      }else{
        if(dateCheck(realMailinputValue.value)){
          const orderIndex = orders.value.findIndex(
          (order) => order.orderId === thisData.value.orderId
        );

        orders.value[orderIndex].shipmentStatus = shipmentInputValue.value
        orders.value[orderIndex].realMailDate = realMailinputValue.value;
        orders.value[orderIndex].shippingCarrier = carrierInputValue.value;
        orders.value[orderIndex].mailer = mailerInputValue.value;

        popUpToggle();
        }else{
          alert("實際出貨日請輸入'YYYY-MM-DD'格式'或正確日期")
        };        
      }
    };
  // 輸入日期檢查
  const dateCheck = (checkedDate) => {
      const regex = /^\d{4}-\d{2}-\d{2}$/;
      //檢查正規表達式是否匹配
      if(!regex.test(checkedDate)){return false};

      // 檢查日期是否存在
      const date = new Date(checkedDate);
      const [year, month, day] = checkedDate.split('-').map(Number);

      return date.getFullYear() === year &&
      date.getMonth()+1 === month &&
      date.getDate() === day;

    };


</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>