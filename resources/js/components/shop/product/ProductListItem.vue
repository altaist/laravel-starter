<template>
    <div>
        <q-card class="my-card" flat bordered>
            <!--q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" /-->
            <q-img :src="'/img/' + (item.img || 'item1.jpg')" />

            <q-card-section>
                <CartButton :item="item" mode="fab"/>
                <FavoritesButton :item="item" mode="fab"/>

                <div class="row no-wrap items-center">
                    <div class="col text-h6 ellipsis">
                        {{ item.title }}
                    </div>
                    <div class="col-auto text-grey text-caption q-pt-md row no-wrap items-center">
                        <q-icon name="place" />
                        {{ item.place }}
                    </div>
                </div>

                <q-rating v-model="item.stars" :max="5" size="32px" />
            </q-card-section>

            <q-card-section class="q-pt-none">
                <div class="text-subtitle1">
                    Стоимость: {{ item.price }}
                </div>
                <div class="text-caption text-grey">
                    {{ item.description }}
                </div>
            </q-card-section>

            <q-separator />

            <q-card-actions align='center'>

                <q-btn flat color="primary">
                    Подробнее
                </q-btn>
            </q-card-actions>
        </q-card>
    </div>
</template>
<script setup>
import { useCollection } from '@/composables/collection';
import FavoritesButton from '@/components/shop/favorites/FavoritesButton.vue';
import CartButton from '@/components/shop/cart/CartButton.vue';

const props = defineProps({
    item: {
        type: Object,
        default: ''
    }
});
const emit = defineEmits(['click:favorites:add', 'click:favorites:remove', 'click:cart:add', 'click:cart:remove']);


</script>
