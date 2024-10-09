<template>
    <div>
        <div v-if="viewMode == 'dense'">
            <q-list bordered padding>
                <div v-for="product in items">
                    <ProductListItemDense :item="product" />
                </div>
            </q-list>
        </div>
        <div v-else>
            <div v-for="product in items" class="q-my-md">
                <ProductListItem :item="product"></ProductListItem>
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
const emit = defineEmits(['click']);


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
