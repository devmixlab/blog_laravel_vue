<script setup>
import List from './List.vue'

const props = defineProps({
    categories: {
        type: Array,
        default: [],
    },
    routeName: {
        type: String,
        required: true,
    },
});

</script>

<template>

    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <List :routeName="routeName" :categories="categories" />
        </div>
    </div>

</template>
