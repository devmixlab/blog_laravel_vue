<script setup>
import { ref, onMounted, reactive } from "vue";
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import Helper from '@/Compositions/Helper.js'
const {formatDate, firstLetterToUppercase, getUrlQueryParamsAsObj} = Helper();

DataTable.use(DataTablesCore);

const modal  = ref(null)
const dataTable  = ref(null)
let dt;

let myModal;
// let mounted = false;
// let mounted = reactive(false);
onMounted(() => {
    // console.log('component mounted');
    myModal = new bootstrap.Modal(modal.value, {
        keyboard: false
    })

    dt = dataTable.value.dt;

    // myModal.on( 'draw', function ( e, json, data ) {
    //     console.log(333)
    // });
    // mounted = true;
});

function onDraw() {
    console.log(333)
    let nodes = document.querySelectorAll('.add-post-to-top-list');
    nodes.forEach((node, idx) => {
        node.addEventListener("click", function(e) {
            const id = this.dataset.id;
            const idx = topPosts.findIndex(e => e === id);
            if(idx < 0){
                topPosts.push(id);
            }else{
                topPosts.splice(idx, 1);
            }

            dt.draw();
        })
    })
}

function open () {
    myModal.show();
    // console.log(modal.value)
}

defineExpose({
    open
});

const topPosts = reactive([]);

const columns = [
    {
        data: 'title',
        title: 'Title',
        render: (data, type, row, meta) => {
            return firstLetterToUppercase(data);
        }
    },
    {
        data: 'created_at',
        title: 'Created At',
        render: (data, type, row, meta) => {
            return formatDate(data);
        }
    },
    {
        data: null,
        title: 'Top',
        render: (data, type, row, meta) => {
            if(!topPosts.find(e => e == row.id))
                return '';
            return `<span class="badge rounded-pill bg-success">Top</span>`;
        }
    },
    {
        data: null,
        render: (data, type, row, meta) => {
            if(topPosts.find(e => e == row.id))
                return `
                    <a href="#" data-id="${row.id}" type="button" class="add-post-to-top-list btn btn-sm btn-light active">Remove</a>
                `;
            if(topPosts.length >= 5)
                return '<small>Max 5 top items</small>';
            return `
                <a href="#" data-id="${row.id}" type="button" class="add-post-to-top-list btn btn-sm btn-light">Add</a>
            `;
        }
    },
];

const options = {
    // responsive: true,
    autoWidth: false,
    select: true,
    serverSide: true,
    "ordering": false,
    searching: true,
    lengthChange: false,
    pageLength: 5,
    // info: false,
    // "dom": 'rtip',
    columnDefs:[
        {targets: [1], className: "width-200 text-center"},
        {targets: [2,3], className: "width-100 text-center"}
    ]
};

</script>

<template>

    <!-- Modal -->
    <div ref="modal" class="modal modal-xl fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

<!--                    {{topPosts}}-->

                    <DataTable
                        ref="dataTable"
                        :ajax="route('dashboard.latest_posts')"
                        :columns="columns"
                        :options="options"
                        @draw="onDraw"
                        class="table table-striped table-hover w-100"
                    />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</template>
