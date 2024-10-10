<template>
    <div class="text-h6 q-pa-md bg-deep-orange-4 text-white rounded-1" @click="emit('click')">
        <slot/>
    </div>
</template>
<script setup>

const emit = defineEmits(['click']);
</script>
