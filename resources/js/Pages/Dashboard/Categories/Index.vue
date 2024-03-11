<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SearchFoundAlert from '@/Components/Blog/Search/FoundAlert.vue';
import Flash from '@/Components/FlashSuccess.vue';
import DropdownWithPosts from '@/Components/Blog/DropdownWithPosts.vue';
import TableList from '@/Components/Blog/List/List.vue';
import Helper from '@/Compositions/Helper.js'

const {formatDate, firstLetterToUppercase, } = Helper();

const props = defineProps([
    'paginator','total'
])

const columns = [
    {
        title: {
            name: "Title"
        },
        data: {
            propName: 'title',
            modify: (data) => {
                return firstLetterToUppercase(data);
            }
        },
    },
    {
        class: "width-120 text-center",
        title: {
            name: "Posts Count"
        },
        data: {
            propName: 'posts_count',
            modify: (data) => {
                return data ?
                    `<span class="badge bg-success">${data}</span>` :
                    `<small class="text-muted">No posts</small>`;
            }
        },
    },
    {
        class: "width-140 text-center",
        title: {
            name: "Created At",
        },
        data: {
            propName: 'created_at',
            modify: (data) => {
                const date = formatDate(data, "D MMMM, YYYY");
                const time = formatDate(data, "HH:mm:s");
                return `${date}<br/><small class="text-muted">${time}</small>`;
            },
        },
    }
];

</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            Posts
        </template>

        <Flash />

        <TableList :paginator="paginator"
                   :total="total"
                   :columns="columns"
                   modelName="tag"
                   :componentDropdownWithPosts="{
                        component: DropdownWithPosts,
                        props: {
                            routeName: 'dashboard.category.index'
                        }
                    }"
                   indexRouteName="dashboard.category.index"
                   createRouteName="dashboard.category.create"
                   createRouteEdit="dashboard.category.edit"
                   destroyRouteName="dashboard.category.destroy"
                   destroyAllRouteName="dashboard.category.destroy_all"/>

    </AuthenticatedLayout>
</template>
