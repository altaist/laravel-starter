<template>
    <div class="q-ma-md">
        <section-title @click="emit('click:title')">{{ title }}</section-title>
    </div>
    <div class="q-ma-sm">
        <slot/>
    </div>
</template>
<script setup>

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click:title']);
</script>
