<template>
    <ProductListItem :item="product" :show-more="false" :show-details="true"/>
</template>
<script setup>
import ProductListItem from './ProductListItem.vue';

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    product: {
        type: Object,
        default: null
    }
});
const emit = defineEmits(['click']);

</script>
