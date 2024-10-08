<template>
    <shop-page-header @click:profile="onClickProfile" @click:lang="onClickLang" @click:wallet="onClickWallet"/>
    <section class="text-center">
        <h4>
            КАТАЛОГ
        </h4>
    </section>
    <section class="text-center">
        <catalog/>
    </section>

    <DialogFixed v-model="dialogProfileVisibility">
        <Profile></Profile>
    </DialogFixed>

</template>
<script setup>
import { ref } from 'vue';
import { authAndAutoReg, user } from '@/composables/auth'
import ShopPageHeader from './shared/ShopPageHeader.vue'
import ShopPageFooter from './shared/ShopPageFooter.vue'
import DialogFixed from './shared/DialogFixed.vue'
import Catalog from "./catalog/Catalog.vue";
import Profile from "./profile/Profile.vue";


const props = defineProps({
    title: {
        type: String,
        default: ''

    },
});
const emit = defineEmits(['click']);

const dialogProfileVisibility = ref(false);
const dialogLangVisibility = ref(false);
const dialogWalletVisibility = ref(false);
const dialogEnterCodeVisibility = ref(false);

const onClickProfile = () => {
    dialogProfileVisibility.value = true;
}

const onClickLang = () => {
    dialogLangVisibility.value = true;
}

const onClickWallet = () => {
    dialogWalletVisibility.value = true;
}

const onClickCode = () => {
    dialogEnterCodeVisibility.value = true;
}

authAndAutoReg();

</script>
