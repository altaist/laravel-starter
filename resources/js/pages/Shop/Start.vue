<template>
    <Head title="Rent Agent" />
    <page-container>
        <div class="text-left q-pa-md">
            {{ TWA }}
            <div class="q-my-xl text-h2 text-deep-orange">
                Сервис Аренды Одежды
            </div>
            <div class="text-h5 text-deep-orange" v-if="name">
                Добро пожаловать, {{ name }}
            </div>
            <div class="text-h5 text-deep-orange" v-else>
                Добро пожаловать!
            </div>
            <div class="q-my-xl"><q-btn label="Перейти" size="lg" color="deep-orange" :href="route('shop.main')"/></div>

        </div>
    </page-container>

</template>
<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import { getTwaUser } from '@/composables/auth';

//const TWA = getCurrentInstance().appContext.config.globalProperties.TWA;
const TWA = window.TWA;
const name = ref(getTwaUser()?.name);


</script>
