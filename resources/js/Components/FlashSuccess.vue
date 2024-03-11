<script setup>
import {ref, watch, computed} from "vue";
import { usePage } from '@inertiajs/vue3';

const page = usePage()

const disabled = ref(false)
const success = computed(() => page.props.flash.success);
// const responseTime = computed(() => page.props.flash.response_time);
const responseTime = computed(() => page.props.response_time);

watch(responseTime, (n, o) => {
    setSuccess()
})

function setSuccess() {
    let isSuccess = Boolean(success.value);
    disabled.value = isSuccess ? null : false;
    setTimeout(() => {
        isSuccess = Boolean(success.value);
        // console.log(success.value)
        disabled.value = isSuccess
    }, 100)
}

setSuccess();

function onClose() {
    disabled.value = false;
}

</script>


<template>
    <div :class="{
        'visually-hidden': disabled === false
    }">
        <div :class="{ shake: disabled }" key="flash_success" class="alert alert-success alert-dismissible fade show" role="alert">
            <span v-html="success"></span>
            <button type="button" class="btn-close" @click.prevent="onClose"></button>
        </div>
    </div>
</template>
