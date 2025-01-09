<template>
    <div class="dropdown-qa"
        :class="{'-expand': isExpand}" 
        @click="toggleDropdown">
        <div class="question-block">
            <div class="question">
                <span>Q</span>
                <p>{{ question }}</p>
            </div>
            <img class="expandBtn" src="@/assets/img/icon/chev-red.svg" alt="chev-red">

        </div>
        <template v-if="isExpand">
            <hr>
            <div class="answer">
                <span>A</span>
                <p>{{ answer }}</p>
            </div>
        </template>
    </div>
</template>

<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        question: {
            type: String,
            required: true,
        },
        answer: {
            type: String,
            required: true,
        }
    });

    const isExpand = ref(false);

    function toggleDropdown() {
        isExpand.value = !isExpand.value;
    }
</script>