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

        <tr v-for="items in 10">
          <td>001</td>
          <td>海綿寶寶</td>
          <td>tibametibame@tibame.com</td>
          <td>4</td>
          <td>3</td>
          <td>2</td>
          <td>正常</td>
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
</script>

<style lang="scss" scoped>
@import '../../assets/sass/style.scss';
@import '../../assets/sass/page/backend';
</style>