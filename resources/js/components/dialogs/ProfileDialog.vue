<template>
    <q-dialog v-model="visible">
        <q-card>
            <q-card-section>
                <div class="text-h6">{{ t('langs.select_lang') }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <btn label="Выйти" @click="onLogout"></btn>

            </q-card-section>

        </q-card>
    </q-dialog>
</template>
<script setup>
import { useLangs } from '@/utils/locales';
import { requestPost } from '@/utils/requests';

const visible = defineModel();
const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);

const { langs, setCurrentLang } = useLangs();

const onLogout = (item) => {
    requestPost('logout');
}

</script>
