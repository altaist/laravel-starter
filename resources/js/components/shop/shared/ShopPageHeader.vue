<template>
    <div class="q-py-md">
        <div class="row">
            <div class="col"><btn @click="emit('click:profile')" icon="fa-solid fa-house-user" /></div>
            <div class="col text-center"><btn @click="emit('click:lang')" icon="fa-solid fa-bookmark" /></div>
            <div class="col text-right"><btn @click="emit('click:wallet')" icon="fa-solid fa-cart-shopping" /></div>
        </div>
    </div>
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

const emit = defineEmits(['click:profile', 'click:lang', 'click:wallet']);


</script>
