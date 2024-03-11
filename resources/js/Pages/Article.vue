<script setup>
import BlogLayout from '@/Layouts/BlogLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Article from '@/Components/Article.vue';
import Comments from '@/Components/Blog/Comments.vue';
import FrontCard from '@/Components/Blog/Categories/FrontCard.vue';
// import Search from '@/Components/SearchArticle.vue';
// import DeleteUserForm from './Partials/DeleteUserForm.vue';
// import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
// import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';

// console.log(posts)

defineProps({
    post: {
        type: Object,
    },
    categories: {
        type: Array,
        default: []
    },
    routeName: {
        type: String,
        required: true
    },
});
</script>

<template>
    <Head>
        <title>{{post.seo_title}}</title>
        <meta name="description" :content="post.seo_description">
        <meta name="keywords" :content="post.seo_keywords">
    </Head>

    <BlogLayout>

        <div class="container mt-5">
            <div class="row px-2">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <Article :routeName="routeName" :post="post" :isFull="true" />
<!--                    <Comments :post="post" />-->
                </div>

                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Categories widget-->
                    <FrontCard :routeName="routeName" :categories="categories" />
                </div>
            </div>
        </div>

    </BlogLayout>
</template>
