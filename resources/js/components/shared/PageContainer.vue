<template>
    <div class="q-px-md">
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
