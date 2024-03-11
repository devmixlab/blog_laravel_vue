<script setup>
import TopNavbar from './Navbars/GuestTop.vue';
import AdminTopNavbar from './Navbars/AdminTop.vue';
import Breadcrumbs from '@/Components/Blog/Breadcrumbs.vue';

</script>

<template>
    <div class="">

        <AdminTopNavbar v-if="admin" />
        <TopNavbar />

        <div class="container mt-5 pb-5">
            <div class="ps-2">
                <Breadcrumbs :hideIfOnlyOne="true" />
            </div>

            <slot />
        </div>
    </div>
</template>
