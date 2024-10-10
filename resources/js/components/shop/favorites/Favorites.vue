<template>
    <div v-if="favorites.getFavorites().length > 0">
        <div>
            <ProductList :items="favorites.getFavorites()" view-mode="dense" />
        </div>
        <div class="q-my-lg">
            <div>
                <q-btn label="Очистить все" size="md" @click="clear()" />
            </div>

        </div>

    </div>
    <div v-else>
        <b>Список избранного пуст</b>
    </div>

</template>
<script setup>
import { useFavorites } from '@/composables/shop';
import ProductList from '@/components/shop/product/ProductList.vue'


const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);

const favorites = useFavorites();

const clear = () => {
    favorites.clear();
}

</script>
