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

// console.log(props.categories)

watch(props.categories, (n, o) => {
    console.log(props.categories.length)
    setCategories(n)
})

function setCategories(categories) {
    if(categories.length === 0)
        return;

    const categoriesL = categories.filter((category, idx) => {
        return idx % 2 === 0;
    });
    categoriesLeft.push(...categoriesL);

    const categoriesR = categories.filter((category, idx) => {
        return idx % 2 !== 0;
    });
    categoriesRight.push(...categoriesR);
}

const categoriesLeft = reactive([]);
const categoriesRight = reactive([]);

setCategories(props.categories);

</script>

<template>

<!--    {{categories}}-->
    <div v-if="categories.length" class="row">
        <div class="col-sm-6">
            <ul class="list-unstyled mb-0">
                <li class="py-1 px-2 text-center" v-for="category in categoriesLeft">
                    <ListItem :category="category" :routeName="routeName" />
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <ul class="list-unstyled mb-0">
                <li class="py-1 px-2 text-center" v-for="category in categoriesRight">
                    <ListItem :category="category" :routeName="routeName" />
                </li>
            </ul>
        </div>
    </div>
    <div v-else>
        No categories specified yet.
    </div>

</template>
