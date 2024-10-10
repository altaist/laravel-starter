<template>
    <div class="q-my-xl" :style="'min-height:' + height">
        <div class="q-ma-md" v-if="title">
            <section-title @click="emit('click:title')">{{ title }}</section-title>
            <q-separator class="q-mt-sm"/>
        </div>
        <div class="q-my-md">
            <slot />
        </div>
    </div>
</template>
<script setup>

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    height: {
        type: String,
        default: ''
    }
});
const emit = defineEmits(['click:title']);
</script>
