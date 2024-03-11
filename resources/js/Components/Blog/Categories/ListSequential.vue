<script setup>
import ListItem from './ListItem.vue';
// import Helper from '@/Compositions/Helper.js'
import {reactive, watch} from 'vue';

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

// watch(props.categories, (n, o) => {
//     // console.log(props.categories.length)
//     setCategories(n)
// })

// function setCategories(categories) {
//     categoriesLeft = categories.filter((category, idx) => {
//         return idx % 2 === 0;
//     });
//     categoriesRight = categories.filter((category, idx) => {
//         return idx % 2 !== 0;
//     });
// }
//
// let categories = reactive([]);
// let categoriesRight = reactive([]);

</script>

<template>

    <!--    {{categories}}-->
    <div v-if="categories.length" class="row">

        <div class="d-flex flex-wrap justify-content-center">
            <ListItem v-for="category in categories" :category="category" :routeName="routeName" />
        </div>
<!--        <div class="col-sm-6">-->
<!--            <ul class="list-unstyled mb-0">-->
<!--                <li class="py-1 px-2 text-center" v-for="category in categoriesLeft">-->
<!--                    <ListItem :category="category" :routeName="routeName" />-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="col-sm-6">-->
<!--            <ul class="list-unstyled mb-0">-->
<!--                <li class="py-1 px-2 text-center" v-for="category in categoriesRight">-->
<!--                    <ListItem :category="category" :routeName="routeName" />-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
    <div v-else>
        No categories specified yet.
    </div>

</template>
