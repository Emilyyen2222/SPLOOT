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
            v-for="(option, index) in options" :key="option"
            @click="selectItem(option)">{{ option.name }}</li>
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
      options: {
          type: Array,
          required: true,
      }
  });

  const placeHolder = ref(props.placeHolder);

  const isExpand = ref(false);

  function toggleDropdown(){
    isExpand.value = !isExpand.value;
  }
  function selectItem(o){
    placeHolder.value = o.name;
  }
</script>