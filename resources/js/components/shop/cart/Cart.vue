<template>
    <div v-if="cart.getCart().length > 0">
        <div>
            <ProductList :items="cart.getCart()" view-mode="dense" />
        </div>
        <div class="q-my-lg">
            <div>
                <q-btn label="Очистить все" size="md" @click="clear" />
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
const emit = defineEmits(['click']);

const cart = useCart();

const clear = () => {
    cart.clear();
    cart.update();
}

</script>
