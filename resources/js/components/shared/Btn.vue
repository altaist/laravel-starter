<template>
    <q-btn :label="label" @click="emit('click')"/>
</template>
<script setup>

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);
</script>
