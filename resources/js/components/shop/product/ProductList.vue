<template>
    <div>
        <div v-if="viewMode == 'dense'">
            <q-list bordered separator padding clickable>
                <template v-for="product in items">
                    <ProductListItemDense :item="product" @click:product="emit('click:product', $event)"/>
                </template>
            </q-list>
        </div>
        <div v-else>
            <div v-for="product in items" class="q-my-md">
                <ProductListItem :item="product" @click:product="emit('click:product', $event)"></ProductListItem>
            </div>
        </div>

    </div>
</template>
<script setup>
import { useFavorites } from '@/composables/shop';
import { useCollection } from '@/composables/collection';
import ProductListItem from './ProductListItem.vue';
import ProductListItemDense from './ProductListItemDense.vue';

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    items: {
        type: Array,
        default: []
    },
    viewMode: {
        type: String,
        default: 'list'
    }
});
const emit = defineEmits(['click:product']);


const favorites = useFavorites();

const addToCart = (product) => {
    shop.addToCart(product);
    //    shop.clearCart();
    shop.update();
}
const removeFromCart = (product) => {
    shop.removeFromCart(product);
    shop.update();
}

const clearCart = (product) => {
    shop.clearCart();
    shop.update();
}

const addToFavorites = (product) => {
    favorites.add(product);
    favorites.update();
}
const removeFromFavorites = (product) => {
    favorites.remove(product);
    favorites.update();
}

const clearFavorites = (product) => {
    favorites.clear();
    favorites.update();
}
</script>
