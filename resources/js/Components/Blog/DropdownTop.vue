<script setup>
import List from '@/Components/Blog/Categories/ListSequential.vue';
import {reactive} from 'vue';
import { Link } from '@inertiajs/vue3';
import Helper from '@/Compositions/Helper.js'
import {TopEnum, TopTitles} from '@/Components/Blog/Enums/Top.js';

// console.log(TopTitles)
// console.log(TopEnum.ALL)
// console.log(TopTitles[TopEnum.ALL])

const props = defineProps({
    topPostsCount: {
        type: Number,
        default: 0,
    },
    notTopPostsCount: {
        type: Number,
        default: 0,
    },
    totalCount: {
        type: Number,
        default: 0,
    },
    routeName: {
        type: String,
        required: true,
    },
});

const {getUrlQueryParamsAsObj} = Helper();

const urlQuery = getUrlQueryParamsAsObj();
// let top = reactive(links[0].title);
// const top = urlQuery.top;

// axios.get(route('dashboard.category.index', {
//     all: true
// })).then((response) => {
//     // categories.splice(0);
//     // categories.push(...response.data);
// })

const links = [
    {
        title: TopTitles[TopEnum.ALL],
        value: TopEnum.ALL,
        link: route(props.routeName, Object.assign({}, urlQuery, {
            top: TopEnum.ALL
        }))
    },
    {
        title: TopTitles[TopEnum.ONLY_TOP],
        value: TopEnum.ONLY_TOP,
        link: route(props.routeName, Object.assign({}, urlQuery, {
            top: TopEnum.ONLY_TOP
        }))
    },
    {
        title: TopTitles[TopEnum.ONLY_NOT_TOP],
        value: TopEnum.ONLY_NOT_TOP,
        link: route(props.routeName, Object.assign({}, urlQuery, {
            top: TopEnum.ONLY_NOT_TOP
        }))
    },
];

let top = links[0];
if(urlQuery.top){
    const idx = links.findIndex((e) => e.value == urlQuery.top);
    if(idx >= 0)
        top = links[idx];
}
// let top = urlQuery.top ? urlQuery.top : links[0].title;

// const top = reactive('All');

// console.log(props.categories)

</script>

<template>

    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Posts: {{top.title}}
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" :class="{
                'bg-success': topPostsCount,
                'bg-warning': !topPostsCount,
            }">
                <span class="fw-normal">Top</span> {{topPostsCount}}
            </span>
        </button>
        <!--        {{categories}}-->
        <ul @click.stop class="dropdown-menu">
            <template v-for="(itm, idx) in links">
                <li v-if="itm.value !== top.value">
                    <Link :href="itm.link" class="dropdown-item">{{ itm.title }}</Link>
                </li>
            </template>
        </ul>
    </div>

</template>
