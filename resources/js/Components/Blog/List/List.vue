<script setup>
import SearchInput from '@/Components/Blog/Search/Input.vue';
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SearchFoundAlert from '@/Components/Blog/Search/FoundAlert.vue';
import ShownItemsOnPage from '@/Components/Blog/ShownItemsOnPage.vue';
// import TopAction from './TopAction.vue';
import { usePage, router } from '@inertiajs/vue3'
import { reactive, computed } from 'vue'

import Helper from '@/Compositions/Helper.js'

const page = usePage()
const {formatDate, firstLetterToUppercase, getUrlQueryParamsAsObj} = Helper();

const urlQuery = getUrlQueryParamsAsObj();

const props = defineProps([
    'paginator','total','indexRouteName','createRouteName',
    'destroyRouteName','destroyAllRouteName',
    'columns','createRouteEdit','modelName','componentDropdown',
    'componentDropdownTop','componentDropdownWithPosts'
])

// console.log(props.componentDropdown)

// const search = getUrlQueryParamsAsObj(['search'], true);

const data = computed(() => {
    return props.paginator.data;
})

// let data = props.paginator.data;
const links = props.paginator.links;
const current_page = props.paginator.current_page;
const per_page = props.paginator.per_page;

const firstRowOnThisPage = current_page * per_page - per_page + 1;

function confirmDelete() {
    if(!confirm("Are you sure?"))
        return false;

    // page.props.flash.success = false;
}

// console.log(data)

// function onSuccessDeleteAll() {
//     // data.splice(0, data.length);
//     router.visit(route('dashboard.post.index', {
//         preserveState: true,
//     }));
// }

function onSuccessDelete(id) {
    return (response) => {
        // console.log(props.paginator.data.length)


        // if(props.paginator.prev_page_url === null)
        //     return;
        //
        // if(props.paginator.data.length === 0)
        //     router.visit(props.paginator.prev_page_url, {
        //         // preserveState: true,
        //         // replace: true,
        //     });


        // console.log(id);
        // console.log(response);
        // let row = data.find(obj => {
        //     return obj.id === id;
        // })
        // const index = data.findIndex(obj => obj.id === id);
        // data.splice(index, 1);
        // if(data.length === 0 && props.paginator.prev_page_url){
        //     router.visit(props.paginator.prev_page_url);
        // }

        // console.log(index)
    }
    // return confirm("Are you sure?");
}

</script>

<template>
    <div>
        <div class="d-flex justify-content-between pb-3 pt-2">
            <div class="d-flex">
                <div v-if="total" class="dropdown me-2">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{paginator.per_page}} items
                    </a>

                    <ul class="dropdown-menu min-width-auto">
                        <li v-for="perPage in [1,2,10,20,50,100]">
                            <Link v-if="paginator.per_page != perPage" class="dropdown-item" :href="route(indexRouteName, Object.assign({}, urlQuery, {
                                perPage: perPage,
                            }))">{{perPage}} items</Link>
                        </li>
                    </ul>
                </div>

                <SearchInput v-if="total" :route="indexRouteName" />

<!--                <component is="componentDropdown" />-->
                <div v-if="componentDropdown && total" class="ps-2">
                    <component :is="componentDropdown.component" v-bind="componentDropdown.props"></component>
                </div>

                <div v-if="componentDropdownTop && total" class="ps-2">
                    <component :is="componentDropdownTop.component" v-bind="componentDropdownTop.props"></component>
                </div>

                <div v-if="componentDropdownWithPosts && total" class="ps-2">
                    <component :is="componentDropdownWithPosts.component" v-bind="componentDropdownWithPosts.props"></component>
                </div>

            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <Link :href="route(createRouteName)" class="btn btn-outline-primary">
                    <i class="bi bi-plus"></i>
                    Create
                </Link>
                <Link v-if="total" class="btn btn-outline-danger" :onBefore="confirmDelete" :href="route(destroyAllRouteName)" method="post" :data="{ _method: 'delete' }" as="button" type="button">
                    <i class="bi bi-trash"></i>
                    Delete All
                </Link>
            </div>
        </div>

        <SearchFoundAlert :paginator="paginator"
                          :routeName="indexRouteName" />

        <table v-if="data.length" class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th v-for="column in columns"
                    :class="column.title?.class ? column.title.class : (column.class ?? '')">
                    {{ column.title?.name ?? '' }}
                </th>
                <th class="width-140 text-end">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(p, idx) in data" :key="p.id">
                <td style="width: 1%!important;" class="w-auto text-nowrap">{{firstRowOnThisPage + idx}}</td>
                <td :class="column.data?.class ? column.data?.class : (column.class ?? '')" v-for="column in columns">
                    <div v-if="column.data?.modify" v-html="column.data.modify(p[column.data.propName])"></div>
                    <div v-else v-html="p[column.data.propName]"></div>
                </td>
<!--                <td>{{ firstLetterToUppercase(p.title) }}</td>-->
<!--                <td class="width-140 text-center">{{ formatDate(p.created_at) }}</td>-->
                <td class="width-140 text-end">
<!--                    <slot :item="p" name="actions"></slot>-->
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <slot :item="p" :idx="idx" name="actions"></slot>
                        <Link :href="route(createRouteEdit, {[modelName]: p.id})" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-pencil"></i>
                            Edit
                        </Link>
                        <Link class="btn btn-outline-danger btn-sm" :onBefore="confirmDelete" :onSuccess="onSuccessDelete(p.id)" :href="route(destroyRouteName, {[modelName]: p.id})" method="post" :data="{ _method: 'delete' }" as="button" type="button">
                            <i class="bi bi-trash"></i>
                            Delete
                        </Link>
<!--                        <Link type="button" class="btn btn-outline-primary btn-sm">Edit</Link>-->
<!--                        <Link type="button" class="btn btn-outline-danger btn-sm">Delete</Link>-->
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
<!--        <div v-if="!data.length" class="alert alert-light py-2 px-2" role="alert">-->
<!--            No items-->
<!--        </div>-->

        <ShownItemsOnPage :key="paginator.total" class="mb-3" :paginator="paginator">
            <template v-slot:noItems>
                <div class="px-2 py-2 alert alert-light" role="alert">
                    No Items
                </div>
            </template>
        </ShownItemsOnPage>
<!--        {{paginator.data.length}}-->
        <Pagination :key="paginator.total" v-if="paginator.total" :paginator="paginator" />

    </div>
</template>
