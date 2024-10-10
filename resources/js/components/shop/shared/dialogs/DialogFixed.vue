<template>
    <q-dialog v-model="visibility" full-width full-height>
      <q-card >
        <q-card-section>
          <div class="text-h4 text-secondary">{{ title }}</div>
        </q-card-section>

        <q-separator />

        <q-card-section style="min-height: 70vh; max-height:73vh" class="scroll">
            <slot/>
        </q-card-section>

        <q-separator />

        <q-card-actions align="right">
          <q-btn flat size="lg" label="Закрыть" color="secondary" v-close-popup />
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
