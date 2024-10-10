<template>
    <page-section title="Избранное">
        <div v-if="favorites.getFavorites().length > 0">
        <div>
            <ProductList :items="favorites.getFavorites()" view-mode="dense" @click:product="emit('click:product', $event)" />
        </div>
        <div class="q-my-lg text-right">
            <div>
                <q-btn icon="fa-solid fa-trash" size="md" color="accent" @click="clear" />
            </div>
        </div>

    </div>
    <div v-else>
        <b>Список избранного пуст</b>
    </div>

    </page-section>

    <page-section title="Мои коллекции как Стилиста">
        <div>У вас нет своих коллекций. Сейчас мы вам расскажем, как сделать первую</div>
    </page-section>

    <page-section title="Присланные мне коллекции">
        <div>Вам никто не прислал никаких коллекций. Можете попробовать поискать Стилиста</div>
    </page-section>

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
