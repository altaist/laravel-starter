<template>
    <q-dialog v-model="visible" persistent>
        <q-card style="min-width: 350px">
            <q-card-section>
                <div class="text-h6">Your address</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input dense v-model="address" autofocus @keyup.enter="prompt = false" />
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn flat label="Cancel" v-close-popup />
                <q-btn flat label="Send" @click="onCodeEnter" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
<script setup>
import { ref } from 'vue';
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

const address = ref('');

const onCodeEnter = () => {
    debug('Code enter');
}

</script>
