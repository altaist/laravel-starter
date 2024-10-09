<template>
    <div>
        <q-list bordered class="rounded-borders">

            <q-expansion-item>
                <template v-slot:header="{ expanded }">
                    <q-item-section avatar>
                        <q-avatar>
                            <img src="https://cdn.quasar.dev/img/boy-avatar.png">
                        </q-avatar>
                    </q-item-section>

                    <q-item-section>
                        Иванов Петр
                    </q-item-section>
                </template>

                <q-card>
                    <q-card-section>
                        Расширенная информация и дополнительные поля ввода
                    </q-card-section>
                </q-card>
            </q-expansion-item>
        </q-list>
    </div>
</template>
<script setup>

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);
</script>
