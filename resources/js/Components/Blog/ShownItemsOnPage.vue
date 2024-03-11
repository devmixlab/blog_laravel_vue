<template>
    <div v-if="paginator.total">
        Shown <b>{{ range }}</b> of total <b>{{ total }}</b> items.
    </div>
    <div v-else>
        <slot v-if="$slots.noItems" name="noItems"></slot>
        <span v-else>No items</span>
    </div>
</template>

<script setup>

const props = defineProps({
    paginator: {
        type: Object,
    },
});

const total = props.paginator.total;
const start = total ?
    props.paginator.current_page * props.paginator.per_page - props.paginator.per_page + 1 : null;
const end = total && props.paginator.data.length > 1 ?
    start + props.paginator.data.length - 1 : null;

let range = null;
if(start && end) {
    range = `${start} - ${end}`;
}else if(start && !end) {
    range = `${start} - ${start}`;
}


// const range = start && end ? `${start} - ${end}` : null;

</script>
