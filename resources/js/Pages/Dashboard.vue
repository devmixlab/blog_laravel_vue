<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps([
    'posts', 'categories'
]);

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
<!--        <template #header>-->
<!--            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>-->
<!--        </template>-->

        <div class="row">
            <div class="col col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-file-earmark-binary-fill"></i>
                        Posts
                    </div>
                    <div class="card-body">
                        <ol class="ps-0">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Total:</div>
                                </div>
                                <span v-if="posts.total > 0" class="badge bg-primary rounded-pill">
                                        {{ posts.total }}
                                    </span>
                                <small class="text-muted" v-else>No data</small>
                            </li>
                            <hr />
                            <div class="ps-3">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="">Top</div>
                                    </div>
                                    <span v-if="posts.top_total > 0" class="badge bg-success rounded-pill">
                                        {{ posts.top_total }}
                                    </span>
                                    <small class="text-muted" v-else>No data</small>
                                </li>
                                <li class="pt-3 list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="">Usual</div>
                                    </div>
                                    <span v-if="posts.not_top_total > 0" class="badge bg-secondary rounded-pill">
                                        {{ posts.not_top_total }}
                                    </span>
                                    <small class="text-muted" v-else>No data</small>
                                </li>
                            </div>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-tags"></i>
                        Categories
                    </div>
                    <div class="card-body">
                        <ol class="ps-0">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Total:</div>
                                </div>
                                <span v-if="categories.total > 0" class="badge bg-primary rounded-pill">
                                    {{ categories.total }}
                                </span>
                                <small class="text-muted" v-else>No data</small>
                            </li>
                            <hr />
                            <div class="ps-3">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="">With posts</div>
                                    </div>
                                    <span v-if="categories.with_posts_total > 0" class="badge bg-success rounded-pill">
                                        {{ categories.with_posts_total }}
                                    </span>
                                    <small class="text-muted" v-else>No data</small>
                                </li>
                                <li class="pt-3 list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="">Without posts</div>
                                    </div>

                                    <span v-if="categories.without_posts_total > 0" class="badge bg-secondary rounded-pill">
                                        {{ categories.without_posts_total }}
                                    </span>
                                    <small class="text-muted" v-else>No data</small>
                                </li>
                            </div>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
