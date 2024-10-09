<template>
    <div class="q-pa-md bg-white" style="z-index: 1;">
        <div class="row">
            <div class="col"><btn @click="emit('click:profile')" icon="fa-solid fa-house-user" /></div>
            <div class="col text-center"><FavoritesButton @click:favorites="emit('click:favorites')"/></div>
            <div class="col text-right"><CartButton @click:cart="emit('click:cart')"/></div>
        </div>
        <div class="q-mt-md"><q-separator /></div>
    </div>
</template>
<script setup>
import CartButton from '@/components/shop/cart/CartButton.vue';
import FavoritesButton from '@/components/shop/favorites/FavoritesButton.vue';

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

const emit = defineEmits(['click:profile', 'click:favorites', 'click:cart']);


</script>
