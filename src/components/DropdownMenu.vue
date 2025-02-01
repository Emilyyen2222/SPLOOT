<!-- Sam -->
<template>
  <div class="dropdownBox">
    <div class="dropdown-menu" :class="props.size" ref="dropdownMenu"
      @click="toggleDropdown">
      <div class="dropdownBtn">
          <span>{{ selectedOption }}</span>
          <img class="expandBtn" :src="themes[route.meta.theme].expandBtn" alt="expandBtn">
      </div>
      <template v-if="isExpand">
        <hr>
        <ul class="dropdownList">
            <li 
              v-for="(option, index) in options" :key="option"
              @click="selectItem(option)">
              <span>{{ option.name }}</span>
            </li>
        </ul>
      </template>
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue';
  import { useRoute } from 'vue-router';

  const route = useRoute();

  const props = defineProps({
      size: {
        type: String,
      },
      placeHolder: {
          type: String,
          required: true,
      },
      options: {
          type: Array,
          required: true,
      },
      modelValue: {
        type: String,
      }
  });
  const emit = defineEmits('update:modelValue');

  const dropdownMenu = ref(null);
  const selectedOption = ref(props.placeHolder);
  const isExpand = ref(false);

  const themes = {
    red: { expandBtn: new URL('@/assets/img/icon/chev-red.svg', import.meta.url).href },
    blue: { expandBtn: new URL('@/assets/img/icon/chev-blue.svg', import.meta.url).href },
  }

  function toggleDropdown(){
    isExpand.value = !isExpand.value;
    dropdownMenu.value.classList.toggle('-expand');
  }
  function selectItem(o){
    selectedOption.value = o.name;
    emit('update:modelValue', o.name);

    if(!dropdownMenu.value.classList.contains('-active')){
      dropdownMenu.value.classList.add('-active');
    }
  }
</script>