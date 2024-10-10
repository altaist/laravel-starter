<template>
    <div :class="['text-center text-h6 q-my-lg q-pa-md', 'rounded', color, text]" :style="'min-height:' + height">
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
    height: {
        type: String,
        default: ''
    }
});
const emit = defineEmits(['click']);
</script>
