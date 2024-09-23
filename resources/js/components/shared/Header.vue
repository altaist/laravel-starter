<template>
    {{ label }}
</template>
<script setup>
const props = defineProps({
    label: {
        type: String
    },
    color: {
        type: String,
        default: 'primary'
    },
    icon: {
        type: String,
        default: undefined
    },

});

const emit = defineEmits(['click']);

</script>
