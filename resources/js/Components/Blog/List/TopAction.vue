<script setup>
import { usePage, Link } from '@inertiajs/vue3';
import {reactive, computed} from "vue";

const page = usePage()

const props = defineProps(['item','idx','routeName']);

const top = reactive({value: Boolean(props.item.top)});

const data = computed(() => {
    return {
        _method: 'patch',
        top: !top.value
    }
});

function onSuccess(response) {
    if(typeof response.props?.flash?.custom_data?.top !== 'undefined'){
        top.value = response.props.flash.custom_data.top;
        // top.value = !data.top;
        console.log(top)
    }
}

// function onBeforeSend() {
//     page.props.flash.success = false;
// }

</script>

<template>
<!--    {{ top }}-->
<!--    sdfs-->
<!--    <Link :href="" class="btn btn-outline-success btn-sm" as="button" type="button">Top</Link>-->
<!--    <Link class="btn btn-outline-danger btn-sm" :onSuccess="onSuccess(p.id)" :href="route(destroyRouteName, {[modelName]: p.id})" method="post" :data="{ _method: 'delete' }" as="button" type="button">-->
    <Link preserve-scroll class="btn btn-sm" :onSuccess="onSuccess" :class="{
        active: top.value,
        'btn-outline-success': top.value,
        'btn-outline-secondary': !top.value,
    }" :href="route(routeName, {post: item.id})" method="post" :data="data" as="button" type="button">
        <i v-if="!top.value" class="bi bi-toggle-off"></i>
        <i v-else class="bi bi-toggle-on"></i>
        Top
    </Link>
</template>
