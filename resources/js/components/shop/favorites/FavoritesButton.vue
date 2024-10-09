<template>
    <div v-if="mode=='total'">
        <q-btn @click="emit('click:favorites')" dense round flat color="deep-orange" icon="fa-solid fa-bookmark" >
        <q-badge v-if="favLength" color="blue" floating>{{ favLength }}</q-badge>
    </q-btn>
    </div>
    <div v-else-if="mode=='list'">
        <q-btn @click="onToggle" dense round flat :color="btnColorComputed" icon="fa-solid fa-bookmark" ></q-btn>
    </div>
    <div v-else-if="mode=='card'">
        <q-btn @click="onToggle" dense round flat :color="btnColorComputed" icon="fa-solid fa-bookmark" ></q-btn>
    </div>
    <div v-else-if="mode=='fab'">
        <q-btn fab :color="btnColorComputed" @click="onToggle" icon="fa-solid fa-bookmark" class="absolute" style="top: 0; left: 12px; transform: translateY(-50%);" />
    </div>
</template>
<script setup>
import { computed, toRefs } from 'vue';
import { useFavorites } from '@/composables/shop.js'

const props = defineProps({
    mode: {
        type: String,
        default: 'total'
    },
    item: {
        type: Object,
        default: null
    }
});
const emit = defineEmits(['click:favorites', 'favorites:toggle']);

const favorites = useFavorites();

const favLength = computed(
    () => favorites.getFavorites()?.length || 0
)

const btnColorComputed = computed(() => {
    return favorites.has(props.item) ? 'deep-orange' : 'primary';
})

const onToggle = () => {
    const isActive = favorites.toggle(props.item);
    favorites.update();
    emit('favorites:toggle', props.item, isActive);
}
</script>
