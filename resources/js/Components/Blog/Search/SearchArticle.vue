<script setup>
import Input from './Input.vue';

const props = defineProps({
    route: {
        type: String,
        required: true,
    },
});

</script>

<template>

    <form @submit.prevent="submit">
        <div class="card mb-4">
            <div class="card-header">Search</div>
            <div class="card-body">
                <Input :route="route"/>
            </div>
        </div>
    </form>

</template>
