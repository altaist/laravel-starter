<template>
    <div :class="['text-center q-ma-lg q-pa-lg', 'rounded', color, text]">
        <slot/>
    </div>
</template>
<script setup>

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    color: {
        type: String,
        default: ''
    },
    text: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);
</script>
