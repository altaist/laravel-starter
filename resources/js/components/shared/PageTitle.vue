<template>
    <div class="text-h2" @click="emit('click')">
        <slot/>
    </div>
</template>
<script setup>

const emit = defineEmits(['click']);
</script>
