<script setup>
import moment from "moment";
import { Link } from '@inertiajs/vue3';
import Comment from './Comment.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    isFull: {
        type: Boolean,
        default: false,
    },
});

function getDate(date) {
    return moment(date).format('MMMM D, YYYY');
}

function firstLetterToUppercase(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function cutText(str, length) {
    if(str.length <= length)
        return str;

    return str.slice(0, length) + '...';
}

</script>

<template>

    <section class="mb-5">
        <div class="card bg-light">
            <div class="card-body">
                <!-- Comment form-->
                <form class="mb-4">
                    <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                    <div class="d-flex justify-content-end pt-3">
                        <button class="btn btn-primary btn-sm" type="submit">Add comment</button>
                    </div>
                </form>
                <Comment />
            </div>
        </div>
    </section>

</template>
