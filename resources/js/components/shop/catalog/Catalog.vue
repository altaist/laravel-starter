<template>
    <div class="q-my-md">
        <block color="bg-grey-3">
            ФИЛЬТРЫ И ПРОМО
        </block>
        <div class="q-my-md" v-if="shopData">
            <ProductList :items="shopData.catalogs.main" @click:product="emit('click:product', $event)"/>
        </div>


    </div>
</template>
<script setup>

import { useShop, useFavorites } from '@/composables/shop';
import { useCollection } from '@/composables/collection';
import ProductList from '@/components/shop/product/ProductList.vue'

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    catalogKey: {
        type: String,
        default: ''
    }
});
const emit = defineEmits(['click:product', 'click:order']);

const shop = useShop();
const shopData = shop.shopData;


</script>
