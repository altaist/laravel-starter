<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col"><btn :label="t('header.btn_profile')" @click="emit('click:profile')"/></div>
            <div class="col text-center"><btn :label="t('header.btn_langs')" @click="emit('click:lang')"/></div>
            <div class="col text-right"><btn :label="t('header.btn_wallet')" @click="emit('click:wallet')"/></div>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    label: {
        type: String
    },
    color: {
        type: String,
        default: 'primary'
    },
    icon: {
        type: String,
        default: undefined
    },

});

const emit = defineEmits(['click:profile', 'click:lang', 'click:wallet']);


</script>
