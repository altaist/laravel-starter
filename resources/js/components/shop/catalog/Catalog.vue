<template>
    <div class="q-my-md">
        <block color="bg-grey-3">
            ФИЛЬТРЫ
        </block>
        <block color="bg-orange-3">
            СПИСОК ТОВАРОВ
        </block>
    </div>
</template>
<script setup>

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);
</script>
