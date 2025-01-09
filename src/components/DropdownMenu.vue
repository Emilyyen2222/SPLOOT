<template>
  <div class="dropdown-menu"
    :class="{'-expand': isExpand}"
    @click="toggleDropdown">
    <div class="dropdownBtn">
        <span>{{ placeHolder }}</span>
        <img class="expandBtn" src="@/assets/img/icon/chev-red.svg" alt="chev-red">
    </div>
    <template v-if="isExpand">
      <hr>
      <ul class="dropdownList">
          <li 
            v-for="(item, index) in menuItems" :key="item"
            @click="selectItem(item)">{{ item.name }}</li>
      </ul>
    </template>
  </div>
</template>

<script setup>
  import { ref } from 'vue';

  const props = defineProps({
      placeHolder: {
          type: String,
          required: true,
      },
      menuItems: {
          type: Array,
          required: true,
      }
  });

  const placeHolder = ref(props.placeHolder);

  const isExpand = ref(false);

  function toggleDropdown(){
    isExpand.value = !isExpand.value;
  }
  function selectItem(item){
    placeHolder.value = item.name;
  }
</script>