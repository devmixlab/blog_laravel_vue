<script setup>
import { Link } from '@inertiajs/vue3';
import Helper from '@/Compositions/Helper.js'
import {TopEnum, TopTitles} from '@/Components/Blog/Enums/Top.js';
import {WithPostEnum, WithPostTitles} from '@/Components/Blog/Enums/WithPost.js';

const {getUrlQueryParamsAsObj} = Helper();
const urlQuery = getUrlQueryParamsAsObj(['search','tag','top','with_post'], true);
const {search, tag, top, with_post} = urlQuery;
const topTitle = TopTitles[top];
const withPostTitle = WithPostTitles[with_post];

// console.log(withPostTitle)
// console.log([WithPostEnum.WITHOUT, WithPostEnum.WITH])
// console.log([WithPostEnum.WITHOUT, WithPostEnum.WITH].includes(withPostTitle))

defineProps({
    paginator: {
        type: Object,
        required: true
    },
    routeName: {
        type: String,
        required: true
    },
});

</script>

<template>
    <div v-if="
        search || tag ||
        [TopEnum.ONLY_NOT_TOP, TopEnum.ONLY_TOP].includes(top) ||
        [WithPostEnum.WITHOUT, WithPostEnum.WITH].includes(with_post)
    " class="alert alert-info py-2 px-2" role="alert">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="mb-0">Results for:</h5>
            </div>
            <div class="width-140 text-end">
                <Link class="ms-2 btn btn-info btn-sm" :href="route(routeName)">
                    Cancel All <i class="bi bi-x-lg"></i>
                </Link>
            </div>
        </div>
        <hr/>
        <div>
            <Link v-if="search" class="ms-2 btn btn-info btn-sm" :href="route(routeName, Object.assign({}, urlQuery, {search: null}))">
                Search term: <b>{{search}}</b> <i class="bi bi-x-lg"></i>
            </Link>
            <Link v-if="tag" class="ms-2 btn btn-info btn-sm" :href="route(routeName, Object.assign({}, urlQuery, {tag: null}))">
                Category: <b>{{tag}}</b> <i class="bi bi-x-lg"></i>
            </Link>
            <Link v-if="top && [TopEnum.ONLY_NOT_TOP, TopEnum.ONLY_TOP].includes(top)" class="ms-2 btn btn-info btn-sm" :href="route(routeName, Object.assign({}, urlQuery, {top: null}))">
                Top: <b>{{topTitle}}</b> <i class="bi bi-x-lg"></i>
            </Link>
            <Link v-if="withPostTitle && [WithPostEnum.WITHOUT, WithPostEnum.WITH].includes(with_post)" class="ms-2 btn btn-info btn-sm" :href="route(routeName, Object.assign({}, urlQuery, {with_post: null}))">
                Posts: <b>{{withPostTitle}}</b> <i class="bi bi-x-lg"></i>
            </Link>
        </div>
    </div>
</template>
