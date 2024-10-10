<template>
    <page-section title="Предмет одежды">
        <div class="border">
            <ProductListItemDense :item="product" @click:product="emit('click:product', $event)" />
        </div>
    </page-section>
    <page-section title="Параметры сделки">
        <q-list bordered class="rounded-borders">
            <q-expansion-item group="somegroup" expand-separator icon="fa-solid fa-calendar-days" default-opened label="Сроки аренды"
                caption="Период, на который будут арендованы товары" header-class="text-secondary text-h6">
                <q-card>
                    <q-card-section>
                        <q-date v-model="rentPeriod" range full-width color="secondary"/>
                    </q-card-section>
                </q-card>
            </q-expansion-item>

            <q-expansion-item group="somegroup" expand-separator icon="fa-solid fa-earth-americas" label="Адреса" caption="Адреса доставки" header-class="text-secondary text-h6">
                <q-card>
                    <q-card-section>
                        Здесь можно будет выбрать адреса для самостоятельной доставки, забора и возврата одежды курьером
                    </q-card-section>
                </q-card>
            </q-expansion-item>

            <q-expansion-item group="somegroup" expand-separator icon="fa-solid fa-comments" label="Чат с арендодателем" caption="Коммуникации участников сделки" header-class="text-secondary text-h6">
                <q-card>
                    <q-card-section>
                        <div style="width: 100%; max-width: 400px">
                            <q-chat-message name="Я" avatar="https://cdn.quasar.dev/img/avatar1.jpg" :text="['Скажите, где куиили?']" stamp="7 minutes ago" sent bg-color="amber-7" />
                            <q-chat-message name="Евгения" avatar="https://cdn.quasar.dev/img/avatar5.jpg" :text="['В Милане, 2 года назад']" stamp="4 minutes ago" text-color="white"
                                bg-color="primary" />
                        </div>
                    </q-card-section>
                </q-card>
            </q-expansion-item>


        </q-list>



    </page-section>
    <page-section title="Этапы сделки">
        <div class="q-my-md">
            Здесь отображаются все этапы сделки. Даты проставляются автоматически в зависимости от указанных сроков
        </div>
        <q-timeline color="secondary">


            <q-timeline-entry title="Новый заказ" subtitle="09.10.2024" avatar="https://cdn.quasar.dev/img/avatar2.jpg">
                <div>
                    Предмет был выбран в каталоге и запрос отправлен арендодателю
                </div>
            </q-timeline-entry>

            <q-timeline-entry title="Подтвержден" subtitle="09.10.2024">
                <div>
                    Арендодатель ответил арендатору, подтвердил заказ и отправил реквизиты для оплаты
                </div>
            </q-timeline-entry>

            <q-timeline-entry title="Оплачен" subtitle="10.10.2024" color="deep-orange" icon="done_all">
                <div>
                    Арендатор оплатил аренду одним из способов, предусмотренных в системе или напрямую
                </div>
            </q-timeline-entry>

            <q-timeline-entry title="Получен" subtitle="10.10.2024">
                <div>
                    Предмет аренды должен быть получен арендатором одним из способов, предусмотренных системой. Здесь возможны отдельные этапы - передан курьеру, в доставке,
                    передан арендатору
                </div>
            </q-timeline-entry>

            <q-timeline-entry title="Возвращен" subtitle="11.10.2024">
                <div>
                    Предмет аренды был возвращен арендодателю. Арендодатель посмотрел и проверил вещь и подтвердил возврат
                </div>
            </q-timeline-entry>
            <q-timeline-entry title="Закрыт" subtitle="11.10.2024">
                <div>
                    Сделка закрыта. Стороны подтвердили взаимное выполнение обязательств, оставили отзывы друг о друге и закрыли сделку
                </div>
            </q-timeline-entry>
        </q-timeline>
    </page-section>
</template>
<script setup>
import { ref } from 'vue'

import ProductListItem from '@/components/shop/product/ProductListItem.vue';
import ProductListItemDense from '@/components/shop/product/ProductListItemDense.vue';

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    product: {
        type: Object,
        default: null
    }
});
const emit = defineEmits(['click:product']);

const rentPeriod = ref({ from: '2020/07/08', to: '2020/07/17' })
</script>
