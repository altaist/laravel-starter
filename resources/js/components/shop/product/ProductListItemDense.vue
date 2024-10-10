<template>
        <q-item clickable v-ripple @click="emit('click:product', item)" style="min-height: 100px;">
            <q-item-section avatar>
                <q-avatar rounded size="xl">
                    <img :src="'/img/' + (item.img || 'item1.jpg')">
                </q-avatar>
            </q-item-section>

            <q-item-section>
                <q-item-label>{{ item.title }}</q-item-label>
                <q-item-label caption> {{ item.description }}</q-item-label>
            </q-item-section>

            <q-item-section side >
                <q-item-label caption>{{ item.price }}</q-item-label>
            </q-item-section>
        </q-item>

</template>
<script setup>
import { useCollection } from '@/composables/collection';
import FavoritesButton from '@/components/shop/favorites/FavoritesButton.vue';
import CartButton from '@/components/shop/cart/CartButton.vue';

const props = defineProps({
    item: {
        type: Object,
        default: null
    }
});
const emit = defineEmits(['click:product', 'click:favorites:add', 'click:favorites:remove', 'click:cart:add', 'click:cart:remove']);

const click = (product) => {
    console.log(product);
}
</script>
