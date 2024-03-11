<script setup>
import {ref, watch, computed} from "vue";
import { usePage } from '@inertiajs/vue3';

const page = usePage()

const disabled = ref(false)
const fail = computed(() => page.props.flash.fail);
// const responseTime = computed(() => page.props.flash.response_time);
const responseTime = computed(() => page.props.response_time);

watch(responseTime, (n, o) => {
    setFail()
})

function setFail() {
    let isFail = Boolean(fail.value);
    disabled.value = isFail ? null : false;
    setTimeout(() => {
        isFail = Boolean(fail.value);
        disabled.value = isFail
    }, 100)
}

setFail();

function onClose() {
    disabled.value = false;
}

</script>


<template>
    <div :class="{
        'visually-hidden': disabled === false
    }">
        <div :class="{ shake: disabled }" class="alert alert-danger alert-dismissible fade show" role="alert">
            <span v-html="fail"></span>
            <button type="button" class="btn-close" @click.prevent="onClose"></button>
        </div>
    </div>
</template>
