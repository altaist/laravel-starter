<template>
    <div class="text-h6" @click="emit('click')">
        <slot/>
    </div>
</template>
<script setup>

const emit = defineEmits(['click']);
</script>
