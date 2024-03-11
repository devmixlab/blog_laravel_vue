<script setup>
import Navbar from './Navbar.vue';
import Breadcrumbs from '@/Components/Blog/Breadcrumbs.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Navbar />

    <div class="container-fluid">

        <!-- Page Content -->
        <main class="px-2 pt-3 pb-5">
            <Breadcrumbs :hideIfOnlyOne="true" />
            <slot />
        </main>
    </div>
</template>
