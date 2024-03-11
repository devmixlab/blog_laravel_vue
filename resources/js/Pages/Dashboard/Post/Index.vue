<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { router, Head, Link } from '@inertiajs/vue3';
import Flash from '@/Components/FlashSuccess.vue';
import Dropdown from '@/Components/Blog/Categories/Dropdown.vue';
import DropdownTop from '@/Components/Blog/DropdownTop.vue';
import TopAction from '@/Components/Blog/List/TopAction.vue';

import TableList from '@/Components/Blog/List/List.vue';
import Helper from '@/Compositions/Helper.js'
import { onMounted, ref } from 'vue'

const {formatDate, firstLetterToUppercase, } = Helper();

const props = defineProps([
    'paginator','total','total_top','categories'
])

onMounted(() => {
    const listTags = document.querySelectorAll('.list-tags');
    listTags.forEach((el) => {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            router.visit(this.getAttribute('href'))

            console.log(this)
        })
    });
})


// console.log(props.categories)

const columns = [
    {
        class: "width-100 text-center",
        title: {
            name: "Image"
        },
        data: {
            propName: 'path',
            modify: (data) => {
                if(!data)
                    return `<small class="text-muted">No image</small>`
                return `
                    <img class="img-fluid" src="${data}" />
                `;
            }
        },
    },
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
        class: "width-200 text-center",
        title: {
            name: "Categories"
        },
        data: {
            propName: 'categories',
            modify: (data) => {
                if(data.length === 0)
                    return `<small class="text-muted">No categories</small>`;

                // return `<slot :item="{}" :idx="1" name="actions"></slot>`;
                let out = ``;
                data.forEach((itm) => {
                    const r = route('dashboard.post.index', {
                        tag: itm.title
                    });
                    out += `<a class="list-tags badge bg-secondary text-decoration-none link-light me-1" href="${r}">${itm.title}</a>`;
                    // return out;
                });
                return out;
                // return firstLetterToUppercase(data);
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
                return formatDate(data);
            },
        },
    }
];

</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            Postsfsd
        </template>

        <Flash />

<!--        <Dropdown />-->
        <TableList :paginator="paginator"
            :total="total"
            :columns="columns"
            modelName="post"
            :componentDropdown="{
                component: Dropdown,
                props: {
                    categories: categories,
                    routeName: 'dashboard.post.index'
                }
            }"
           :componentDropdownTop="{
                component: DropdownTop,
                props: {
                    routeName: 'dashboard.post.index',
                    topPostsCount: props.total_top,
                }
            }"
            indexRouteName="dashboard.post.index"
            createRouteName="dashboard.post.create"
            createRouteEdit="dashboard.post.edit"
            destroyRouteName="dashboard.post.destroy"
            destroyAllRouteName="dashboard.post.destroy_all">
                <template v-slot:actions="slotProps">
                    <TopAction v-bind="slotProps" routeName="dashboard.post.update" />
                </template>
        </TableList>

    </AuthenticatedLayout>
</template>
