<script setup>
import { Link } from '@inertiajs/vue3';
import Helper from '@/Compositions/Helper.js'
import {WithPostEnum, WithPostTitles} from '@/Components/Blog/Enums/WithPost.js';

const props = defineProps({
    routeName: {
        type: String,
        required: true,
    },
});

const {getUrlQueryParamsAsObj} = Helper();
const urlQuery = getUrlQueryParamsAsObj();

// console.log(WithPostEnum)

const links = [
    {
        title: WithPostTitles[WithPostEnum.ALL],
        value: WithPostEnum.ALL,
        link: route(props.routeName, Object.assign({}, urlQuery, {
            with_post: WithPostEnum.ALL
        }))
    },
    {
        title: WithPostTitles[WithPostEnum.WITH],
        value: WithPostEnum.WITH,
        link: route(props.routeName, Object.assign({}, urlQuery, {
            with_post: WithPostEnum.WITH
        }))
    },
    {
        title: WithPostTitles[WithPostEnum.WITHOUT],
        value: WithPostEnum.WITHOUT,
        link: route(props.routeName, Object.assign({}, urlQuery, {
            with_post: WithPostEnum.WITHOUT
        }))
    },
];

let withPost = links[0];
if(urlQuery.with_post){
    const idx = links.findIndex((e) => e.value == urlQuery.with_post);
    if(idx >= 0)
        withPost = links[idx];
}

</script>

<template>

    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Posts: {{withPost.title}}
        </button>
        <!--        {{links}}-->
        <ul @click.stop class="dropdown-menu">
            <template v-for="(itm, idx) in links">
                <li v-if="itm.value !== withPost.value">
                    <Link :href="itm.link" class="dropdown-item">{{ itm.title }}</Link>
                </li>
            </template>
        </ul>
    </div>

</template>
