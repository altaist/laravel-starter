<template>
    <div v-if="mode == 'total'">
        <q-btn @click="emit('click:cart')" dense round flat color="deep-orange" icon="fa-solid fa-cart-shopping">
            <q-badge v-if="cartLength" color="blue" floating>{{ cartLength }}</q-badge>
        </q-btn>
    </div>
    <div v-else-if="mode == 'list'">
        <q-btn @click="onToggle" dense round flat :color="btnColorComputed" icon="fa-solid fa-cart-shopping"></q-btn>
    </div>
    <div v-else-if="mode=='fab'">
        <q-btn fab :color="btnColorComputed" @click="onToggle" icon="fa-solid fa-cart-shopping" class="absolute" style="top: 0; right: 12px; transform: translateY(-50%);" />
    </div>
</template>

<script setup>
import { computed, toRefs } from 'vue';
import { useCart } from '@/composables/shop.js'

const props = defineProps({
    mode: {
        type: String,
        default: 'total'
    },
    item: {
        type: Object,
        default: null
    }
});const emit = defineEmits(['click:cart', 'cart:toggle']);

const cart = useCart();

const cartLength = computed(
    () => cart.getCart()?.length || 0
)

const btnColorComputed = computed(() => {
    return cart.has(props.item) ? 'deep-orange' : 'primary';
})

const onToggle = () => {
    const isActive = cart.toggle(props.item);
    cart.update();
    emit('cart:toggle', props.item, isActive);
}
</script>
