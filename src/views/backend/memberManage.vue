<template>
  <BackendHeader active="會員管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>會員管理</h6>
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
        <th>會員 ID</th>
        <th>姓名</th>
        <th>電子信箱</th>
        <th>寵物數量</th>
        <th>寵物盒訂閱數</th>
        <th>小幫手貼文數量</th>
        <th>帳號狀態正常</th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="(data, index) in viewData" :key="data.memberId">
          <td>{{ data.memberId }}</td>
          <td>{{ data.memberName }}</td>
          <td>{{ data.email }}</td>
          <td>{{ data.petNumber }}</td>
          <td>{{ data.splootBoxSub }}</td>
          <td>{{ data.helperPost }}</td>
          <td>{{ data.accountStatus }}</td>
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

  <!-- 彈出視窗 -->
  <PopUp
  :is-pop-up="isPopUp"
  >
  <div class="popUpContainer">
    <div class="nav">
      <ul v-for ="(nav, index) in navs">
        <li class="navli">
          <Btn @click="navSelected(index)" :btnStyle="['small',selectedNav === nav.name ? 'primary' : 'outline']">{{ nav.name }}</Btn> 
        </li>
      </ul>
    </div>
    <div class="content">
      <div class="leftContent">
        <div class="leftItem">
          <p class="item">會員ID：</p>
          <p class="item">姓名：</p>
          <p class="item">暱稱：</p>
          <p class="item">性別：</p>
          <p class="item">生日：</p>
          <p class="item">電子信箱：</p>
          <p class="item">手機號碼：</p>
          <p class="item">聯絡地址：</p>
          <p class="item">LINE：</p>
        </div>
        <div class="rightItem">
          <p class="item">{{ thisData.memberId }}</p>
          <p class="item">海綿寶寶方褲褲</p>
          <p class="item">{{ thisData.memberName }}</p>
          <p class="item">男生</p>
          <p class="item">{{ thisData.email }}</p>
          <p class="item">1896-07-14</p>
          <p class="item">0900000000</p>
          <p class="item">比奇堡貝殼街 124 號</p>
          <p class="item">squarepants</p>
        </div>
      </div>
      <div class="rightContent">
        <div class="leftItem">
          <p class="item">帳號狀態：</p>
          <p class="item">寵物數量：</p>
          <p class="item">寵物訂閱盒數量：</p>
          <p class="item">小幫手貼文數量：</p>
          <p class="item">帳號創建時間：</p>
        </div>
        <div class="rightItem">
          <p class="item">
            <DropdownMenu class="dropdownInput"
              :placeHolder="thisData.accountStatus"
              :options="accountType"
              v-model="accountEditData">
            </DropdownMenu>
          </p>
          <p class="item">{{ thisData.petNumber }}</p>
          <p class="item">{{ thisData.splootBoxSub }}</p>
          <p class="item">{{ thisData.helperPost }}</p>
          <p class="item">1897-01-01</p>
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
  import {ref} from "vue";
  import {useBackend} from "@/utils/backendUtils";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";
  import PopUp from "@/components/PopUp.vue"
  import DropdownMenu from "../../components/DropdownMenu.vue";

  const members = ref(
    Array.from({length:103},(value,x) => ({
      memberId: `${x+1}`.padStart(4,'0'), 
      memberName: `海綿寶寶${x+1}`,
      email:`tibame${x+1}@tibame.com`, 
      petNumber: 4, 
      splootBoxSub: 3, 
      helperPost: 2, 
      accountStatus: '正常'
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
        isPopUp,
        thisData,
        popUpToggle,
  } = useBackend(members, 'memberId');  

  //專用函式
  //查看與編輯導航
       
    const selectedNav = ref("會員資訊");

    const navs = ref([
      {name: '會員資訊'},
      {name: '寵物資訊'},
      {name: '寵物盒訂閱資訊'},
      {name: '小幫手資訊'},
    ]);
    
    const navSelected = (index) => {
      selectedNav.value = navs.value[index].name;
    };

    // 帳號狀態
    const accountType =ref([
      {name:'正常'},
      {name:'已停用'},
    ]);

    // 帳號狀態雙向綁定
    const accountEditData = ref("");

    
</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';


// 彈出視窗
.popUpContainer{
  padding: 0 80px;

  .nav{
    display: flex;
    justify-content: center;
    gap: 20px;
  }

  .content{
    display: flex;
    gap: 80px;

    margin: 16px 0;

    .item{
      margin-bottom: 20px;
    }

    .leftContent{
      display: flex;

      .leftItem{
        width: 128px;
      }
    }

    .rightContent{
      display: flex;

      .leftItem{
        width: 200px;
      }

      .rightItem{
        width: 160px;
      }
    }
  }

  .popBtnBox{
    display: flex;
    justify-content: center;
    gap: 20px;
  }
}
</style>