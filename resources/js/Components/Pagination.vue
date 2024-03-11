<template>
    <nav v-if="links">
        <ul class="pagination mb-0">
            <template :key="link.url" v-for="(link, idx) in links">
                <template v-if="link.url === null">
                    <li v-if="idx > 0 && (idx + 1) < links.length" class="page-item disabled">
                        <span class="page-link" v-html="link.label"></span>
                    </li>
                    <li v-else-if="idx == 0" class="page-item disabled">
                        <span class="page-link">« <span class="text-label">Previous</span></span>
                    </li>
                    <li v-else-if="idx + 1 == links.length" class="page-item disabled">
                        <span class="page-link"><span class="text-label">Next</span> »</span>
                    </li>
                </template>
                <li v-else class="page-item" :class="{active: link.active}">
                    <template v-if="link.active">
<!--                        <span v-if="idx == 0" class="page-link">ff</span>-->
<!--                        <span v-else class="page-link" v-html="link.label"></span>-->
                        <span class="page-link" v-html="link.label"></span>
                    </template>
                    <template v-else>
                        <Link v-if="idx == 0" :href="link.url" class="page-link">
                            « <span class="text-label">Previous</span>
                        </Link>
                        <Link v-else-if="idx + 1 == links.length" :href="link.url" class="page-link">
                            <span class="text-label">Next</span> »
                        </Link>
                        <Link v-else :href="link.url" v-html="link.label" class="page-link" />
<!--                        <Link :href="link.url" v-html="link.label" class="page-link" />-->
                    </template>
                </li>
            </template>
        </ul>
    </nav>
</template>

<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3';
    import {computed, reactive, watch} from "vue";
    import Helper from "@/Compositions/Helper";

    const page = usePage()
    const {getUrlQueryParamsAsObj} = Helper();

    const props = defineProps({
        paginator: {
            type: Object,
        },
    });

    const links = computed(() => {
        return props.paginator?.links ?? null;
    });

    function checkPageAvailability() {
        if(!props.paginator.prev_page_url)
            return;

        const {perPage, page} = getUrlQueryParamsAsObj();

        const minLength = perPage * page - perPage + 1;

        // console.log('minLength: ' + minLength)
        // console.log('total: ' + props.paginator.total)

        if(minLength > props.paginator.total)
            router.visit(props.paginator.prev_page_url);
    }

    checkPageAvailability();
</script>
