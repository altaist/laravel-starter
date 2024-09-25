<template>
    <q-dialog v-model="visible" persistent>
        <q-card style="min-width: 350px">
            <q-card-section>
                <div class="text-h6">{{ title }}</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                <q-input dense v-model="text" autofocus @keyup.enter="visible = false" />
            </q-card-section>

            <q-card-actions align="right" class="text-primary">
                <q-btn flat label="Cancel" v-close-popup />
                <q-btn flat label="Add" @click="onCodeEnter" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
<script setup>
import { ref } from 'vue';
import { sendAction } from '../activity/activities';

const visible = defineModel();
const props = defineProps({
    title: {
        type: String,
        default: 'Your code'
    },
});
const emit = defineEmits(['click']);

const text = ref('');


const onCodeEnter = () => {
    debug('Code enter');
    sendAction(1, { txt: text.value });
    visible.value = false;
}



</script>
