<template>
    <q-dialog v-model="visible">
        <q-card>
            <q-card-section>
                <div class="text-h6">{{ t('langs.select_lang') }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-list bordered separator>
                    <q-item clickable v-ripple v-for="lang in langs" >
                        <q-item-section @click="onItemClick(lang)">{{ lang.label }}</q-item-section>
                    </q-item>
                </q-list>
            </q-card-section>

        </q-card>
    </q-dialog>
</template>
<script setup>
import { useLangs } from '@/utils/locales';

const visible = defineModel();
const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);

const { langs, setCurrentLang } = useLangs();

const onItemClick = (item) => {
    setCurrentLang(item.id);
    window.location.reload();
}

</script>
