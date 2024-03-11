<script setup>
// import moment from "moment";
import { usePage, Link } from '@inertiajs/vue3';
import { computed } from "vue";

const breadcrumbs = usePage().props.breadcrumbs;

// console.log(usePage().props)

const props = defineProps({
    hideIfOnlyOne: {
        type: Boolean,
        required: false,
    },
});

const isShown = computed(() => {
    if(!breadcrumbs || breadcrumbs.length === 0)
        return false;
    if(props.hideIfOnlyOne && breadcrumbs.length < 2)
        return false;

    return true;
});

</script>

<template>

    <nav v-if="isShown" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li v-for="(breadcrumb, idx) in breadcrumbs" class="breadcrumb-item">
                <span v-if="idx + 1 == breadcrumbs.length">
                    {{breadcrumb.title}}
                </span>
                <Link v-else :href="breadcrumb.url">{{breadcrumb.title}}</Link>
            </li>
        </ol>
    </nav>

</template>
