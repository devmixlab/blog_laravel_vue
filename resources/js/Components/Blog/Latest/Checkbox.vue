<script setup>
// import { useForm } from '@inertiajs/vue3';
// import Helper from '@/Compositions/Helper.js'
// import { ref, reactive, computed, watch } from 'vue'
//
// const {debounce} = Helper();
// const model = defineModel()
//
// let list = reactive([]);
//
// const props = defineProps({
//     // search: {
//     //     type: String,
//     //     // required: true,
//     //     default: ''
//     // },
//     // route: {
//     //     type: String,
//     //     required: true,
//     // },
// });
//
// const emit = defineEmits(["addCategory"])
//
// const onKeyUpDebounced = debounce(event => {
//     // console.log('changed value:', event.target.value);
//     // list.splice(0);
//     // if (event.key === "Enter"){
//     //     event.preventDefault();
//     //     return;
//     // }
//     // console.log(event.key)
//
//     axios.get(route('dashboard.category.index', {
//         search: event.target.value
//     })).then((response) => {
//         list.splice(0);
//         console.log(model.value.length)
//         if(!model.value.length)
//             return;
//
//         list.push(...response.data.data)
//     });
//     // call fetch API to get results
// }, 300);
//
// function emitAddCategory(itm) {
//     model.value = '';
//     list.splice(0);
//     itm.added_at = Date();
//     emit('addCategory', {category: itm});
// }
//
// function onKeyEnterDown(e) {
//     // if (event.key === "Enter"){
//     e.preventDefault();
//     onClickAdd(e);
//     //     return;
//     // }
// }
//
// function onClickAdd(e) {
//     if(!model.value)
//         return;
//
//     // console.log('model.value')
//     // console.log(model.value)
//
//     const index = list.findIndex(item => item.title.trim().toLowerCase() === model.value.trim().toLowerCase());
//
//     if(!list.length || index < 0){
//         // console.log('model.value')
//         // console.log(model.value)
//         emitAddCategory({
//             title: model.value,
//         })
//         return;
//     }
//
//     // const index = list.findIndex(item => item.title.trim().toLowerCase() === model.value.trim().toLowerCase());
//     // // console.log('model.value')
//     // // console.log(model.value)
//     // if(index < 0){
//     //     return;
//     // }
//
//     emitAddCategory(list[index])
// }

</script>

<template>

<!--    <form @submit.prevent="submit">-->
        <!--        {{list}}-->
        <!--        {{listComputed}}-->
        <!--        <div>-->
        <!--            <div v-for="itm in list">{{itm.title}}</div>-->
        <!--        </div>-->

<!--        <div class="input-group">-->
            <!--            <input v-model="form.search" class="form-control" type="text" placeholder="Enter category name..." required>-->
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="topSwitchCheck">
        <label class="form-check-label" for="topSwitchCheck">Set as top article</label>
    </div>
<!--            <input @keydown.enter="onKeyEnterDown" @keyup="onKeyUpDebounced" v-model="model" class="form-control" type="text" placeholder="Enter category name..." required>-->
<!--            <button @click="onClickAdd" class="btn btn-primary" id="button-search" type="submit">Add</button>-->
<!--            <div v-if="list.length" class="list-group position-absolute margin-top-40 border-radius-5">-->
<!--                <a @click.prevent="emitAddCategory(itm)" v-for="itm in list" href="#" class="list-group-item list-group-item-action">{{itm.title}}</a>-->
<!--            </div>-->
<!--        </div>-->

<!--    </form>-->

</template>
