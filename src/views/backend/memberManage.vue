<template>
  <BackendHeader active="會員管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <h6>會員管理</h6>
      <div class="searchBar">
        <InputText
        size="small"
        textAlign="textLeft"
        placeHolder="以會員 ID 查詢"
        ></InputText>
        <Btn btnStyle="primary default">搜尋</Btn>
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

        <!-- <tr v-for="items in 10">
          <td>001</td>
          <td>海綿寶寶</td>
          <td>tibametibame@tibame.com</td>
          <td>4</td>
          <td>3</td>
          <td>2</td>
          <td>正常</td>
          <td><Btn btnStyle="outline small">查看與編輯</Btn></td>
        </tr> -->
        
        <tr v-for="member in members" :key="member.memberId">
          <td>{{ '00' + member.memberId }}</td>
          <td>{{ member.memberName }}</td>
          <td>{{ member.email }}</td>
          <td>{{ member.petNumber }}</td>
          <td>{{ member.splootBoxSub }}</td>
          <td>{{ member.helperPost }}</td>
          <td>{{ member.accountStatues }}</td>
          <td><Btn btnStyle="outline small">查看與編輯</Btn></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
  import {ref} from "vue";
  import BackendHeader from "./backendHeader.vue";
  import InputText from "../../components/InputText.vue";
  import Btn from "../../components/Btn.vue";

  const  members= ref([
      { memberId: 1, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 2, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 3, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 4, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 5, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 6, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 7, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 8, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 9, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
      { memberId: 10, memberName: '海綿寶寶',email:'tibame@tibame.com', petNumber: 4, splootBoxSub: 3, helperPost: 2, accountStatues: '正常'},
    ]   
   )
</script>

<style lang="scss">
@import '../../assets/sass/style.scss';
@import '../../assets/sass/page/backend';
</style>