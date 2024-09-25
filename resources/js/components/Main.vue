<template>
    <page-header @click:profile="onClickProfile" @click:lang="onClickLang" @click:wallet="onClickWallet"/>
    <section class="text-center">
        {{ t('main.title') }}
    </section>
    <page-footer>
    </page-footer>

    <select-lang-dialog v-model="dialogVisibility1"/>

</template>
<script setup>
import { ref } from 'vue';
import SelectLangDialog from '@/components/langs/SelectLangDialog.vue'

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);

const dialogVisibility1 = ref(false);

const onClickProfile = () => {
    redirect(route('main'));
}

const onClickLang = () => {
    dialogVisibility1.value = true;

}

const onClickWallet = () => {

}

</script>
