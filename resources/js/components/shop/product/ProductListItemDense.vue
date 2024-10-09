<template>
    <div>
        <q-item>
            <q-item-section top avatar>
                <q-avatar rounded>
                    <img src="https://cdn.quasar.dev/img/boy-avatar.png">
                </q-avatar>
            </q-item-section>

            <q-item-section>
                <q-item-label>{{ item.title }}</q-item-label>
                <q-item-label caption> {{ item.description }}</q-item-label>
            </q-item-section>

            <q-item-section side top>
                <q-item-label caption>{{ item.price }}</q-item-label>
            </q-item-section>
        </q-item>
    </div>
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
const emit = defineEmits(['click:favorites:add', 'click:favorites:remove', 'click:cart:add', 'click:cart:remove']);


</script>
