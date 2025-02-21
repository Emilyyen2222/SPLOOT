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
        <!-- <tr v-for="(data, index) in viewData" :key="data.memberId">
          <td>{{ data.memberId }}</td>
          <td>{{ data.memberName }}</td>
          <td>{{ data.email }}</td>
          <td>{{ data.petNumber }}</td>
          <td>{{ data.splootBoxSub }}</td>
          <td>{{ data.helperPost }}</td>
          <td>{{ data.accountStatus }}</td>
          <td><Btn btnStyle="outline small" @click="popUpToggle(index)">查看與編輯</Btn></td>
        </tr> -->
        <tr v-for="(user, index) in viewData" :key="user.user_id">
          <td>{{ user.user_id }}</td>
          <td>{{ user.last_name + user.first_name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.pets.length }}</td>
          <td>{{ user.subs.length }}</td>
          <td>{{ user.buddy.posts.length }}</td>
          <td>{{ user.account_status == 1 ? '正常' : '已停用' }}</td>
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
          <p class="item">{{ thisData.user_id }}</p>
          <p class="item">{{ thisData.last_name + thisData.first_name }}</p>
          <p class="item">{{ thisData.nickname }}</p>
          <p class="item">{{ thisData.gender }}</p>
          <p class="item">{{ thisData.birthDate }}</p>
          <p class="item">{{ thisData.email }}</p>
          <p class="item">{{ thisData.phone }}</p>
          <p class="item">{{ thisData.address_city + thisData.address_district + thisData.address_street}}</p>
          <p class="item">{{ thisData.line_id}}</p>
        </div>
      </div>
      <div class="rightContent">
        <div class="leftItem">
          <p class="item">帳號狀態：</p>
          <p class="item">寵物數量：</p>
          <p class="item">寵物訂閱盒數量：</p>
          <p class="item">小幫手貼文數量：</p>
          <p class="item">更新者：</p>
          <p class="item">最後更新時間：</p>
          <p class="item">帳號創建時間：</p>
        </div>
        <div class="rightItem">
          <p class="item">
            <DropdownMenu class="dropdownInput"
              :placeHolder="thisData.account_status == 1 ? '正常' : '已停用'"
              :options="accountType"
              v-model="accountEditData">
            </DropdownMenu>
          </p>
          <p class="item">{{ thisData.pets.length }}</p>
          <p class="item">{{ thisData.subs.length }}</p>
          <p class="item">{{ thisData.buddy.posts.length }}</p>
          <p class="item">{{ thisData.updater }}</p>
          <p class="item">{{ new Date(thisData.last_updated_date).toISOString().split('T')[0] }}</p>
          <p class="item">{{ new Date(thisData.created_date).toISOString().split('T')[0]}}</p>
        </div>
      </div>
    </div>
    <!-- 寵物資訊 -->
     <div class="petDetail content" v-if="selectedNav === '寵物資訊'">
      <div class="top">
        <p>寵物數量：{{ thisData.pets.length }}</p>
      </div>
      <div class="bottom">
        <ul class="petDetailCards">
          <li class="petDetailCard" v-for ="(pet, index) in thisData.pets" :key="index">
            <div class="petCounts">
              <p class="count">{{ index+1 }}</p>
            </div>
            <div class="leftContent">
              <div class="leftItem">
                <p class="item">寵物ID：</p>
                <p class="item">名稱：</p>
                <p class="item">性別：</p>
                <p class="item">品種：</p>
                <p class="item">生日：</p>
                <p class="item">毛孩介紹：</p>
              </div>
              <div class="rightItem">
                <p class="item">{{ pet.pet_id }}</p>
                <p class="item">{{ pet.name}}</p>
                <p class="item">{{ pet.gender }}</p>
                <p class="item">{{ pet.breed }}</p>
                <p class="item">{{ pet.birth_date }}</p>
                <p class="item">{{ pet.description}}</p>
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
                <p class="item">{{ pet.petSocial }}</p>
                <p class="item">{{ pet.neutured}}</p>
                <p class="item">{{ pet.petHobby}}</p>
                <p class="item">{{ new Date(pet.created_date).toISOString().split('T')[0] }}</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
     </div>
    <!-- 寵物盒訂閱資訊 -->
     <div class="splootBoxDetail content" v-if="selectedNav === '寵物盒訂閱資訊'">
      <div class="top">
        <p>寵物盒訂閱數量：{{ thisData.subs.length }}</p>
      </div>
      <div class="bottom">
        <ul class="splootBoxDetailCards">
          <li class="splootBoxDetailCard" v-for ="(sub, index) in thisData.subs" :key="index">
            <div class="petCounts">
              <p class="count">{{ index+1 }}</p>
            </div>
            <div class="leftContent">
              <div class="leftItem">
                <p class="item">訂閱ID：</p>
                <p class="item">方案：</p>
                <p class="item">寄送地址：</p>
              </div>
              <div class="rightItem">
                <p class="item">{{ sub.sub_id}}</p>
                <p class="item">{{ `白金卡（十二個月`}}</p>
                <p class="item">{{ sub.deliver_city + sub.deliver_district + sub.deliver_street}}</p>
              </div>
            </div>
            <div class="rightContent">
              <div class="leftItem">
                <p class="item">訂閱日期：</p>
                <p class="item">結束日期：</p>
              </div>
              <div class="rightItem">
                <p class="item">{{ new Date(sub.created_date).toISOString().split('T')[0]}}</p>
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
        <p>小幫手貼文數：{{ thisData.buddy.posts.length }}</p>
        <p>小幫手評分：{{ thisData.buddy.helperCommentRating }}</p>
        <p>小幫手評論數：{{ thisData.buddy.helperCommentCount }}</p>
      </div>
      <div class="bottom">
        <ul class="splootBoxDetailCards">
          <li class="splootBoxDetailCard" v-for ="(post, index) in thisData.buddy.posts" :key="index">
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
                <p class="item">{{ post.post_id }}</p>
                <p class="item">{{ post.service}}</p>
                <p class="item">{{ `${post.service_city} ${post.service_district}`}}</p>
                <p class="item">{{ thisData.buddy.helperAcceptDays }}</p>
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
                <p class="item">{{ thisData.buddy.helperAcceptPets }}</p>
                <p class="item">{{ new Date(post.last_updated_date).toISOString().split('T')[0]}}</p>
                <p class="item">{{ post.description }}</p>
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
  import {ref, onBeforeMount} from "vue";
  import {useBackend} from "@/utils/backendUtils";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "@/components/InputText.vue";
  import Btn from "@/components/Btn.vue";
  import PopUp from "@/components/PopUp.vue"
  import DropdownMenu from "../../components/DropdownMenu.vue";

  const members = ref(
    Array.from({length:103},(value,x) => ({
      memberId: `${x+1}`.padStart(3,'0'), 
      memberName: `海綿寶寶${x+1}`,
      email:`tibame${x+1}@tibame.com`, 
      petNumber: 4, 
      splootBoxSub: 3, 
      helperPost: 4, 
      accountStatus: '正常'
    }))
  );

  const members1 = ref([]);

  // const members = ref([
  //   {
  //     memberId: '3'.padStart(3,'0'),
  //     email: 'email',
  //     memberName: '海綿寶寶',
  //     nickname: '',
  //     gender: '',
  //     birthDate: '',
  //     lineId: '',
  //     phone,
  //     addressCity,
  //     addressDistrict,
  //     addressStreet,
  //     portrait,
  //     accountStatus: '正常',
  //     admin,
  //     updater,
  //     lastUpdatedDate,
  //     createdDate,
  //     pets: [],

      
  //   }
  // ]);

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
  } = useBackend(members1, 'user_id');  

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

  async function findAllUsersPhp() {
    const resp = await fetch(`${import.meta.env.VITE_API_DOMAIN}/tid103/g3/php/backend/findAllUsers.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    try{
      const memberInfo = await resp.json();
      if(memberInfo.status == 'success'){
        const userData = memberInfo.data;
        
        for(let user of userData){
          let birth = new Date(user.birth_date);
          let birthYear = birth.getFullYear();
          let birthMonth = birth.getMonth() + 1;
          let birthDate = birth.getDate();

          user.birthDate = `${birthYear}-${birthMonth}-${birthDate}`
        }
        members1.value = userData;
      }else if(memberInfo.status == 'error'){
        console.log(memberInfo.message);
      }
    } catch (error){
      console.error('Error parsing JSON:', error);
    }
  }

  onBeforeMount(() => {
    findAllUsersPhp();
  })


    
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