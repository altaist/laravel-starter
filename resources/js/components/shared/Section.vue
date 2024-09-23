<template>
    <div>
        <section-title @click="emit('click:title')">{{ title }}</section-title>
    </div>
    <div>
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
