<template>
  <header id="backendHeader">
    <nav class="backend">
      <ul>
        <li
        v-for="(item, index) in [
          {name: '會員管理', link:'/backend/member'},
          {name: '配對管理', link:'/backend/match'},
          {name: '寵物照片審核', link:'/backend/petCard-verify'},
          {name: '寵物盒方案管理', link:'/backend/sploot-box'},
          {name: '訂單管理', link:'/backend/order'},
          {name: '小幫手身份審核', link:'/backend/splootBuddy-verify'},
          {name: '活動管理', link:'/backend/event'},
          {name: '回到前台首頁', link:'/'},
        ]" :key="index">
          <RouterLink :to="item.link" :class="{isAcitve: active == item.name}">
            <Btn v-if="active==item.name" btnStyle="primary default">{{ item.name }}</Btn>
            <Btn v-else btnStyle="white default">{{ item.name }}</Btn>
          </RouterLink>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script setup>
  import { ref, defineProps } from "vue";

  import Btn from "../../components/Btn.vue";

  const props = defineProps({
    active: {
      type: String,
      default: 'none',
    },
    bgc:{
      type: String,
      required: true,
    }
  })
</script>

<style lang="scss" scoped>
template{
  box-sizing: border-box;
}
#backendHeader{
  width: 100vw;
  position: sticky;
  top: 0;

  nav.backend{
    width: 100%;
    max-width: 1216px;

    ul{
      display: flex;
      justify-content: flex-start;
      flex-wrap: wrap;
      gap: .4rem;
      
      padding: 2rem 0;
      width: 100%;
      li{
        // flex-grow: 1;
        max-width: max-content;
        a{
          white-space: nowrap;
        }
      }
    }
  }
}
</style>