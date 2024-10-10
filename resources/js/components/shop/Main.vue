<template>
    <shop-page-header class="fixed-top bg-white"
        @click:profile="onClickProfile"
        @click:favorites="onClickFavorites"
        @click:cart="onClickCart"
    />
    <section class="text-center q-mt-xl q-pt-xl">
        <h4>
            СЕРВИС АРЕНДЫ ОДЕЖДЫ
        </h4>
    </section>
    <section class="text-center">
        <Catalog/>
    </section>

    <DialogFixed title="Профиль" v-model="dialogProfileVisibility">
        <Profile/>
    </DialogFixed>

    <DialogFixed title="Избранное" v-model="dialogFavoritesVisibility">
        <Favorites/>
    </DialogFixed>

    <DialogFixed title="Заказы" v-model="dialogCartVisibility">
        <Cart/>
    </DialogFixed>

</template>
<script setup>
import { ref } from 'vue';
import { authAndAutoReg, user } from '@/composables/auth'
import { useProject } from '@/composables/project'
import { initFakeShop } from '@/composables/fake'

import ShopPageHeader from './shared/ShopPageHeader.vue'
import ShopPageFooter from './shared/ShopPageFooter.vue'
import DialogFixed from './shared/dialogs/DialogFixed.vue'
import Catalog from "./catalog/Catalog.vue";
import Profile from "./profile/Profile.vue";
import Favorites from "./favorites/Favorites.vue";
import Cart from "./cart/Cart.vue";


const props = defineProps({
    title: {
        type: String,
        default: ''

    },
});
const emit = defineEmits(['click']);

const dialogProfileVisibility = ref(false);
const dialogFavoritesVisibility = ref(false);
const dialogCartVisibility = ref(false);
const dialogEnterCodeVisibility = ref(false);

const onClickProfile = () => {
    dialogProfileVisibility.value = true;
}

const onClickFavorites = () => {
    dialogFavoritesVisibility.value = true;
}

const onClickCart = () => {
    dialogCartVisibility.value = true;
}

const onClickCode = () => {
    dialogEnterCodeVisibility.value = true;
}

authAndAutoReg()
    .then(() => {
        useProject().loadSettings();

        initFakeShop();
    });




</script>
