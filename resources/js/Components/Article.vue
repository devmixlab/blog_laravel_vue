<script setup>
import moment from "moment";
import { Link } from '@inertiajs/vue3';
import Helper from '@/Compositions/Helper.js'

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    isFull: {
        type: Boolean,
        default: false,
    },
    articleRouteName: {
        type: String,
        required: false,
    },
});

// console.log(props.post)

const {formatDate, firstLetterToUppercase, cutText} = Helper();

</script>

<template>

    <article>
        <!-- Post header-->
        <header class="mb-3">
            <!-- Post title-->
            <component :is="isFull ? 'h1' : 'h2'">
                <Link v-if="!isFull" :href="route(articleRouteName, {
                    post: post.id
                })">
                    {{ firstLetterToUppercase(post.title) }}
                </Link>
                <span v-else>
                    {{ firstLetterToUppercase(post.title) }}
                </span>
            </component>
            <!-- Post meta content-->
            <div class="text-muted fst-italic mb-2">Posted on {{ formatDate(post.created_at) }}</div>
            <!-- Post categories-->
<!--            {{ post.categories }}-->
            <div v-if="post.categories.length" class="pb-3">
                <Link :href="route('home', {tag: category.title})" v-for="category in post.categories" class="badge bg-secondary text-decoration-none link-light me-1">
                    {{ category.title }}
                </Link>
            </div>
<!--            <div class="article-image" v-if="post.path" :style="{-->
<!--                'background-image': 'url(' + post.path + ')'-->
<!--            }"></div>-->
            <img v-if="post.path" class="img-fluid rounded" :src="post.path" :alt="post.file_alt" />
<!--            <a class="badge bg-secondary text-decoration-none link-light me-1" href="#!">Freebies</a>-->
        </header>
        <!-- Post content-->
        <section class="mb-5">
            <p class="fs-5 mb-4" v-html="post.text"></p>
        </section>
    </article>

</template>

<style lang="scss" scoped>
    .article-image{
        height: 200px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        border-radius: 5px;
    }
</style>
