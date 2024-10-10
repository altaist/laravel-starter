<template>
    <q-dialog v-model="visibility" full-width >
      <q-card>
        <q-card-section>
          <div class="text-h5">{{ title }}</div>
        </q-card-section>

        <q-separator />

        <q-card-section style="max-height: 50vh" class="scroll">
            <slot/>
        </q-card-section>

        <q-separator />

        <q-card-actions align="right">
          <q-btn flat label="Закрыть" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
</template>
<script setup>

const props = defineProps({
    title: {
        type: String,
        default: 'TITLE'
    },
});
const visibility = defineModel();

const emit = defineEmits(['click']);


</script>
