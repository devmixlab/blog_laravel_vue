<script setup>
import BlogLayout from '@/Layouts/BlogLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

const props = defineProps({
    categories: {
        type: Array,
        default: [],
    },
});

</script>

<template>
    <Head>
        <title>Categories</title>
        <meta name="description" content="Blog Categories page description">
        <meta name="keywords" content="Blog Categories page keywords">
    </Head>

    <BlogLayout>

        <div class="px-2">
            <div v-if="categories.length" class="text-center">
                <h4 class="d-inline-block" v-for="category in categories">
                    <Link class="list-tags badge bg-secondary text-decoration-none link-light mx-2 my-2" :href="route('home', {tag: category.title})">
                        {{category.title}}
                    </Link>
                </h4>
            </div>
            <div v-else>
                No items
            </div>
        </div>

    </BlogLayout>
</template>
