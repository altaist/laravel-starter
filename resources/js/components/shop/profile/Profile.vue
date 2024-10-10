<template>
    <div>
        <div class="q-mb-lg">
            <q-list bordered class="rounded-borders">

                <q-expansion-item>
                    <template v-slot:header="{ expanded }">
                        <q-item-section avatar>
                            <q-avatar>
                                <img src="https://cdn.quasar.dev/img/boy-avatar.png">
                            </q-avatar>
                        </q-item-section>

                        <q-item-section class="text-h6">
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
        <page-section>
            <div class="row q-col-gutter-md">
                <div class="col-6 text-left">
                    <q-btn icon="fa-solid fa-gifts" label="Заказы" stack rounded class="q-pa-md full-width" size="lg" color="secondary" />
                </div>
                <div class="col-6 text-right">
                    <q-btn icon="fa-solid fa-handshake" label="Клиенты" stack rounded class="q-pa-md full-width" size="lg" color="secondary" />
                </div>
                <div class="col-6 text-left">
                    <q-btn icon="fa-solid fa-credit-card" label="Платежи" stack rounded class="q-pa-md full-width" size="lg" color="secondary" />
                </div>
                <div class="col-6 text-right">
                    <q-btn icon="fa-solid fa-receipt" label="Архив" stack rounded class="q-pa-md full-width" size="lg" color="secondary" />
                </div>
            </div>
        </page-section>
        <page-section>
            <q-card :class="toggleButique ? 'bg-orange text-white' : 'bg-grey-7 text-white'">
                <q-card-section>
                    <div class="text-h6">Мой Бутик</div>
                    <div class="text-subtitle2">Название бутика</div>
                </q-card-section>

                <q-card-section>
                    Бутик доступен для пользователью с ролью Стилист. Добавить эту роль очень легко - просто активизируйте переключатель внизу
                </q-card-section>

                <q-separator dark />

                <q-card-actions>
                    <q-toggle v-model="toggleButique" label="Активировать" color="deep-orange" /> <q-btn flat class="q-ml-md">Управлять</q-btn>
                </q-card-actions>
            </q-card>
        </page-section>
        <page-section>
            <q-card :class="toggleShop ? 'bg-purple text-white' : 'bg-grey-7 text-white'">
                <q-card-section>
                    <div class="text-h6">Мой Шоу-рум</div>
                    <div class="text-subtitle2">Название шоурума</div>
                </q-card-section>

                <q-card-section>
                    Шоу-рум доступен для пользователью с ролью Арендатор. Добавить эту роль очень легко - просто активизируйте переключатель внизу
                </q-card-section>

                <q-separator dark />

                <q-card-actions>
                    <q-toggle v-model="toggleShop" label="Активировать" /> <q-btn flat class="q-ml-md">Управлять</q-btn>
                </q-card-actions>
            </q-card>
        </page-section>
        <block height="200px" color="bg-orange-2" >
            Дополнительный контент. Инструкции, сслылки, переключатели
        </block>

    </div>
</template>
<script setup>
import { ref } from 'vue';
const props = defineProps({
    title: {
        type: String,
        default: ''
    },
});
const emit = defineEmits(['click']);


const toggleButique = ref(false);
const toggleShop = ref(false);

</script>
