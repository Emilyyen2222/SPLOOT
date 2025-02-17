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
          <Btn @click="navSelected(index)" :btnStyle="['default',selectedNav === nav.name ? 'primary' : 'outline']">{{ nav.name }}</Btn> 
        </li>
      </ul>
    </div>
    <!-- 會員資訊 -->
    <div class="memberDetail content" v-if="selectedNav === '會員資訊'">
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
    <!-- 寵物資訊 -->
     <div class="petDetail content" v-if="selectedNav === '寵物資訊'">
      <div class="top">
        <p>寵物數量：{{ thisData.petNumber }}</p>
      </div>
      <div class="bottom">
        <ul class="petDetailCards">
          <li class="petDetailCard" v-for ="(card, index) in 4" :key="index">
            <div class="petCounts">
              <p class="count">{{ index+1 }}</p>
            </div>
            <div class="leftContent">
              <div class="leftItem">
                <p class="item">寵物ID：</p>
                <p class="item">名稱：</p>
                <p class="item"><br></p>
                <p class="item">性別：</p>
                <p class="item">年齡：</p>
                <p class="item">毛孩介紹：</p>
              </div>
              <div class="rightItem">
                <p class="item">00{{ index+1 }}</p>
                <p class="item">歐西里斯</p>
                <p class="item"><br></p>
                <p class="item">女生</p>
                <p class="item">6</p>
                <p class="item">全名為歐西里斯的天空龍的挪威森林貓，他很黏人吧?</p>
              </div>
            </div>
            <div class="rightContent">
              <div class="leftItem">
                <p class="item">社交性：</p>
                <p class="item">絕育狀態：</p>
                <p class="item">興趣愛好：</p>
                <p class="item">創建時間：</p>
              </div>
              <div class="rightItem">
                <p class="item">親貓親人,小孩友善</p>
                <p class="item">已結紮</p>
                <p class="item">喜歡發呆,喜歡玩球</p>
                <p class="item">2024-09-09</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
     </div>
    <!-- 寵物盒訂閱資訊 -->
     <div class="splootBoxDetail content" v-if="selectedNav === '寵物盒訂閱資訊'">
      <div class="top">
        <p>寵物盒訂閱數量：{{ thisData.splootBoxSub }}</p>
      </div>
      <div class="bottom">
        <ul class="splootBoxDetailCards">
          <li class="splootBoxDetailCard" v-for ="(card, index) in 3" :key="index">
            <div class="petCounts">
              <p class="count">{{ index+1 }}</p>
            </div>
            <div class="leftContent">
              <div class="leftItem">
                <p class="item">訂閱ID：</p>
                <p class="item">方案：</p>
                <p class="item">寄送地址：</p>
                <p class="item"><br></p>
                <p class="item">取貨方式：</p>
                <p class="item">卡片內容：</p>
                <p class="item"><br></p>
              </div>
              <div class="rightItem">
                <p class="item">00{{ index+1 }}</p>
                <p class="item">白金卡（十二個月）</p>
                <p class="item">台北市中山區南京東路三段219號4樓</p>
                <p class="item">宅配到家</p>
                <p class="item">小孩愛吃，已購買</p>
              </div>
            </div>
            <div class="rightContent">
              <div class="leftItem">
                <p class="item">訂閱日期：</p>
                <p class="item">結束日期：</p>
              </div>
              <div class="rightItem">
                <p class="item">2024-12-12</p>
                <p class="item">2025-12-05</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
     </div>
    <!-- 小幫手資訊 -->
     <div class="buddyDetail content" v-if="selectedNav === '小幫手資訊'">
      <div class="top">
        <p>小幫手認證：待審核</p>
        <p>小幫手貼文數：{{ thisData.helperPost }}</p>
        <p>小幫手評分：5.0</p>
        <p>小幫手評論數：99</p>
      </div>
      <div class="bottom">
        <ul class="splootBoxDetailCards">
          <li class="splootBoxDetailCard" v-for ="(card, index) in 4" :key="index">
            <div class="petCounts">
              <p class="count">{{ index+1 }}</p>
            </div>
            <div class="leftContent">
              <div class="leftItem">
                <p class="item">貼文ID：</p>
                <p class="item">服務種類：</p>
                <p class="item">服務地區：</p>
                <p class="item">服務時間：</p>
              </div>
              <div class="rightItem">
                <p class="item">00{{ index+1 }}</p>
                <p class="item">{{ 
                index == 0 ? '散步陪伴' : index == 1 ? '到府照顧' : index == 2 ? '友善寄宿' : index == 3 ? '毛孩計程車' : '！錯誤！' 
                }}</p>
                <p class="item">台北市,中山區</p>
                <p class="item">一,二,日</p>
              </div>
            </div>
            <div class="rightContent">
              <div class="leftItem">
                <p class="item">服務寵物：</p>
                <p class="item">最後更新：</p>
                <p class="item">自我介紹：</p>
                <p class="item"><br></p>
              </div>
              <div class="rightItem">
                <p class="item">小型犬, 幼犬, 成貓</p>
                <p class="item">2025-02-18</p>
                <p class="item">唉，真沒勁……不過，我會盡量照顧好你的毛孩，我擅長高速散步、高速接送，都交給我。就算覺得好累，還是得做好這些事，反正我能應付。別擔心，牠們會安全的，應該。</p>
              </div>
            </div>
          </li>
        </ul>
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
      helperPost: 4, 
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
  
  // 雙向綁定資料
  // 帳號狀態雙向綁定
  const accountEditData = ref("");
  
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


    
</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';


// 彈出視窗

.popUpContainer{


  .nav{
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-bottom: 10px;
  }

  .content{
    // border: 1px solid;
    width: 900px;
    height: 450px;  
    padding: 10px 80px 20px;
    overflow-x: auto;


    &.memberDetail{
      display: flex;
      gap: 80px;
  
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
          .item{
            line-height: 42px;
          }
        }
  
        .rightItem{
          width: 160px;

          .item{
            line-height: 42px;
          }
        }
      }
    }
  
    &.petDetail, &.splootBoxDetail, &.buddyDetail{
      .top{
        display: flex;
        gap: 40px;
        margin-bottom: 20px;
      }
      .bottom{
        .petDetailCards, .splootBoxDetailCards, .buddyDetailCards{         
          .petDetailCard, .splootBoxDetailCard, .buddyDetailCard{
          display: flex;
          gap: 80px;

          padding: 20px 0;
          
          border-top: 1px solid map-get($colors, natural-2);

            .petCounts{
              
              .count{
                width: 24px;
                height: 24px;
                border-radius: 50%;
                line-height: 24px;
                text-align: center;
                color: white;
                background-color: map-get($colors, brown);
              }
            }
            .leftContent, .rightContent{
              // border: 1px solid;
              display: flex; 
              
              .leftItem{
                width: 100px;
              }

              .rightItem{
                width: 200px;
              }
            }
          }
        }
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