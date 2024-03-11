<script setup>
import { Link } from '@inertiajs/vue3';
import Helper from '@/Compositions/Helper.js'
import {computed} from 'vue'

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
    routeName: {
        type: String,
        required: true,
    },
});

// console.log(props.category)

const posts_count = computed(() => {
    // return props.category.posts_count ? '(' + props.category.posts_count + ')' : '';
    return props.category.posts_count > 0 ? props.category.posts_count : '';
});

const {getUrlQueryParamsAsObj} = Helper();
const urlQuery = getUrlQueryParamsAsObj(['tag','search','top'], true);
const tag = urlQuery.tag;
const search = urlQuery.search;
</script>

<template>
    <h5 class="mb-0" v-if="tag && tag.trim().toLowerCase() == category.title.trim().toLowerCase()">
        <span class="badge bg-info">
            <span class="fw-normal">{{category.title}}</span> {{posts_count}}
            <Link class="d-inline-block text-light" :href="route(routeName, Object.assign({}, urlQuery, {tag: null}))"><i class="bi bi-x-lg"></i></Link>
        </span>
    </h5>
    <div v-else class="d-flex px-3 py-1">
        <span class="flex-shrink-0 fw-normal">
            <Link :href="route(routeName, Object.assign({}, urlQuery, {tag: category.title}))">{{ category.title }}</Link>
        </span>
        <span class="ms-2 badge bg-success">{{posts_count}}</span>
    </div>

</template>
