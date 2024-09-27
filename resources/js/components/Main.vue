<template>
    <page-header @click:profile="onClickProfile" @click:lang="onClickLang" @click:wallet="onClickWallet"/>
    <section class="text-center">
        {{ t('main.title') }}
        <div>
            {{ user }}
        </div>
    </section>
    <page-footer @click:code="onClickCode">
    </page-footer>

    <select-lang-dialog v-model="dialogLangVisibility"/>
    <profile-dialog v-model="dialogProfileVisibility"/>
    <wallet-dialog v-model="dialogWalletVisibility"/>
    <enter-code-dialog v-model="dialogEnterCodeVisibility"/>

</template>
<script setup>
import { ref } from 'vue';
import { authAndAutoReg, user } from '@/composables/auth';

import SelectLangDialog from '@/components/dialogs/SelectLangDialog.vue'
import ProfileDialog from '@/components/dialogs/ProfileDialog.vue'
import WalletDialog from '@/components/dialogs/WalletDialog.vue'
import EnterCodeDialog from '@/components/dialogs/EnterCodeDialog.vue'

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

authAndAutoReg()
</script>
