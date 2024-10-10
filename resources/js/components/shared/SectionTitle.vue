<template>
    <div class="text-h5 q-pa-md bg-secondary text-white rounded-1" @click="emit('click')">
        <slot/>
    </div>
</template>
<script setup>

const emit = defineEmits(['click']);
</script>
