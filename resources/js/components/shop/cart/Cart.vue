<template>
    <div v-if="cart.getCart().length > 0">
        <div>
            <ProductList :items="cart.getCart()" view-mode="dense" @click:product="emit('click:product', $event)"/>
        </div>
        <div class="q-my-lg text-right">
            <div>
                <q-btn icon="fa-solid fa-trash" size="md" color="red" @click="clear" />
            </div>
        </div>

    </div>
    <div v-else>
        <b>Корзина пуста</b>
    </div>

</template>
<script setup>
import { useCart } from '@/composables/shop';
import ProductList from '@/components/shop/product/ProductList.vue'


const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click:product', 'click:order']);

const cart = useCart();

const clear = () => {
    cart.clear();
    cart.update();
}

</script>
