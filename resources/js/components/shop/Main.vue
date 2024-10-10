<template>
    <div class="bg-white">
        <shop-page-header class="fixed-top bg-white" @click:profile="onClickProfile" @click:favorites="onClickFavorites" @click:cart="onClickCart" />
        <section class="text-center q-mt-xl q-pt-xl">
            <h4>
                СЕРВИС АРЕНДЫ ОДЕЖДЫ
            </h4>
        </section>
        <section class="text-center">
            <Catalog @click:product="onClickProduct" />
        </section>

        <DialogFixed title="Профиль" v-model="dialogProfileVisibility" >
            <Profile />
        </DialogFixed>

        <DialogFixed title="Избранное" v-model="dialogFavoritesVisibility">
            <Favorites @click:product="onClickProduct" />
        </DialogFixed>

        <DialogFixed title="Заказы" v-model="dialogCartVisibility">
            <Cart @click:product="onClickOrder"/>
        </DialogFixed>

        <DialogFixed title="Информация о позиции" v-model="dialogProductVisibility">
            <ProductView :product="activeProduct"/>
        </DialogFixed>

        <DialogFixed title="Информация о сделке" v-model="dialogOrderVisibility">
            <OrderView :product="activeOrder" @click:product="onClickProduct"/>
        </DialogFixed>

    </div>

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
import ProductView from './product/ProductView.vue';
import OrderView from './order/OrderView.vue';


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
const dialogProductVisibility = ref(false);
const dialogOrderVisibility = ref(false);

const activeProduct = ref(null);
const activeOrder = ref(null);

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

const onClickProduct = (product) => {
    console.log(product);
    dialogProductVisibility.value = true;
    activeProduct.value = product;

}

const onClickOrder = (order) => {
    dialogOrderVisibility.value = true;
    activeOrder.value = order;
}

authAndAutoReg()
    .then(() => {
        useProject().loadSettings();

        initFakeShop();
    });




</script>
