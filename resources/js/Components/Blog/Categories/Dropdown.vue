<script setup>
import List from '@/Components/Blog/Categories/ListSequential.vue';
import {reactive} from 'vue';
import Helper from '@/Compositions/Helper.js'

const {getUrlQueryParamsAsObj} = Helper();
const urlQuery = getUrlQueryParamsAsObj();

const props = defineProps({
    // categories: {
    //     type: Array,
    //     default: [],
    // },
    routeName: {
        type: String,
        required: true,
    },
});

const tag = urlQuery.tag;


const categories = reactive([]);

axios.get(route('dashboard.category.index', {
    all: true
})).then((response) => {
    categories.splice(0);
    categories.push(...response.data);
})

// console.log(props.categories)

</script>

<template>

    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ tag ?? 'Categories'}}
        </button>
<!--        {{categories}}-->
        <ul @click.stop class="dropdown-menu min-width-400 w-auto">
            <li class="px-1">
                <List :routeName="routeName" :categories="categories" />
            </li>
        </ul>
    </div>

</template>
