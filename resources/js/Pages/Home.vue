<script setup>
import BlogLayout from '@/Layouts/BlogLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import ShownItemsOnPage from '@/Components/Blog/ShownItemsOnPage.vue';
import FrontCard from '@/Components/Blog/Categories/FrontCard.vue';
import Article from '@/Components/Article.vue';
import Search from '@/Components/Blog/Search/SearchArticle.vue';
import SearchFoundAlert from '@/Components/Blog/Search/FoundAlert.vue';
// import DeleteUserForm from './Partials/DeleteUserForm.vue';
// import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
// import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    posts: {
        type: Object,
    },
    categories: {
        type: Array,
        default: []
    },
});

// console.log(props.posts)

</script>

<template>
<!--    <Head title="Profile" />-->
    <Head>
        <title>Home</title>
        <meta name="description" content="Blog main page description">
        <meta name="keywords" content="Blog main page keywords">
    </Head>

    <BlogLayout>

        <div class="row px-2">
            <div class="col-lg-8">
<!--                <div class="d-none d-lg-block">-->
                <SearchFoundAlert :paginator="posts"
                     routeName="home"/>
                <Article v-for="post in posts.data" :post="post" articleRouteName="article" />

                <div class="pb-3">
                    <ShownItemsOnPage :paginator="posts" />
                </div>
                <Pagination v-if="posts.data.length > 0" :paginator="posts" />
            </div>

            <!-- Side widgets-->
            <div v-if="posts.data.length" class="col-lg-4 pt-5 pt-lg-0">
                <!-- Search widget-->
                <Search route="home"/>
                <!-- Categories widget-->
                <FrontCard routeName="home" :categories="categories" />
            </div>
        </div>

    </BlogLayout>
</template>
