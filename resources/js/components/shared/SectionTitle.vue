<template>
    <div class="text-h4" @click="emit('click')">
        <slot/>
    </div>
</template>
<script setup>

const emit = defineEmits(['click']);
</script>
