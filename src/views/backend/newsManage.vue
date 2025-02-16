<template>
  <BackendHeader active="消息管理" bgc="yellow-1" class="bg-yellow-1"></BackendHeader>

  <div class="wrapper">
    <div class="title">
      <div class="container">
        <h6>消息管理</h6>
        <div class="add">
          <Btn btnStyle="outline small">＋ 新增</Btn>
        </div>
      </div>
      <div class="searchBar">
        <InputText
        size="small"
        textAlign="textLeft"
        placeHolder="以 消息名稱 查詢"
        v-model="inputValue"
        ></InputText>
        <Btn btnStyle="primary default" @click="dataFilter">搜尋</Btn>
      </div>
    </div>

    <table>
      <thead>
        <th>消息 ID</th>
        <th>分類</th>
        <th>名稱</th>
        <th>作者</th>
        <th>發布位置</th>
        <th>上稿日期</th>
        <th>上稿時間</th>
        <th>消息狀態</th>
        <th></th>
      </thead>
      <tbody>        
        <tr v-for="data in viewData" :key="data.newsId">
          <td>{{ data.newsId }}</td>
          <td>{{ data.category }}</td>
          <td>{{ data.title }}</td>
          <td>{{ data.author }}</td>
          <td>{{ data.publishLocation }}</td>
          <td>{{ data.publishDate }}</td>
          <td>{{ data.publishTime }}</td>
          <td>{{ data.newsStatus }}</td>
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

  const news = ref(
    Array.from({length:103},(value,x) => ({
      newsId: `${x+1}`.padStart(4,'0'), 
      category: `寵物盒`,
      title: x % 3 === 1 ? '下一季SPLOOT BOX！！' : x % 2 === 0 ? 'SPLOOT周年慶特輯' : '夏日毛孩有福啦～', 
      author: 'Mysterio', 
      publishLocation: '首頁及新聞中心', 
      publishDate: '2025-02-10', 
      publishTime: '22:22',
      newsStatus: x % 5 === 0 && x !==0 ? '未上架' : '上架',
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
    } = useBackend(news, 'title');  

</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/page/backend';
</style>