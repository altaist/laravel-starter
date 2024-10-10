<template>
    <div v-if="favorites.getFavorites().length > 0">
        <div>
            <ProductList :items="favorites.getFavorites()" view-mode="dense" @click:product="emit('click:product', $event)" />
        </div>
        <div class="q-my-lg text-right">
            <div>
                <q-btn icon="fa-solid fa-trash" size="md" color="red" @click="clear" />
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
const emit = defineEmits(['click:product', 'click:order']);

const favorites = useFavorites();

const clear = () => {
    favorites.clear();
}

</script>
