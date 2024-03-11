<script setup>
import Input from './Input.vue';
import { reactive, computed } from 'vue'

const props = defineProps({
    categories: {
        type: Array,
        default: [],
    },
});

const emit = defineEmits(["categoryUpdated"])

let list = reactive(JSON.parse(JSON.stringify(props.categories)));

let listComputed = computed(() => {
    return list.sort(function (a, b) {
        var dateA = new Date(a.added_at), dateB = new Date(b.added_at)
        return dateB - dateA;
    });
});

function onAddCategory(e) {
    const index = list.findIndex(item => item.title.trim().toLowerCase() === e.category.title.trim().toLowerCase());
    if(index >= 0)
        return;

    list.push(e.category);
    emit('categoryUpdated', {categories: list});
}

function removeCategory(category) {
    const index = list.findIndex(item => item === category);
    list.splice(index, 1);
    emit('categoryUpdated', {categories: list});
}

</script>

<template>

    <div class="card">
        <div class="card-header">
            <span class="fw-bold">Categories</span>
        </div>
        <div class="card-body">
            <Input @addCategory="onAddCategory" />
            <div class="pt-2">
                <span v-for="itm in listComputed" class="badge bg-light text-dark me-2">
                    {{itm.title}}
                    <a @click.prevent="removeCategory(itm)" href=""><i class="bi bi-x-lg"></i></a>
                </span>
            </div>
        </div>
    </div>

</template>
