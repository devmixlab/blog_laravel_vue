<script setup>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import FileCard from '@/Components/Blog/File/Card.vue';
import LatestCard from '@/Components/Blog/Latest/Card.vue';
import SearchInput from '@/Components/Blog/Search/Input.vue';
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';
import CategoriesCard from '@/Components/Blog/Categories/Card.vue';
import Pagination from '@/Components/Pagination.vue';
import SearchFoundAlert from '@/Components/Blog/Search/FoundAlert.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FlashFail from '@/Components/FlashFail.vue';

// const props = defineProps([
//     'categories'
// ])

const form = useForm({
    title: '',
    seo_title: '',
    seo_description: '',
    seo_keywords: '',
    description: '',
    text: '',
    categories: [],
    top: false,
    file: null,
    file_alt: '',
});

const submit = () => {
    form.post(route('dashboard.post.store'), {
        // onFinish: () => form.reset('password'),
    });
};

const editor = ClassicEditor;
const editorConfig = {
    // removePlugins: [  'Image', 'ImageToolbar' ],
    toolbar: [ 'bold', 'italic', 'heading', 'link' , 'bulletedList', 'numberedList', 'blockQuote' ],
    image: {}
}

function onCategoryUpdated(e) {
    form.categories = e.categories;
    // console.log('onCategoryUpdated')
    // console.log(form)
}

</script>

<template>
    <Head title="Create post" />

    <AuthenticatedLayout>

        <div class="d-flex">
            <div class="flex-grow-1 pe-3">
                <FlashFail />

                <form @submit.prevent="submit">

                    <div class="form-group pb-3">
                        <InputLabel class="pb-1" for="title" value="Title" />
                        <TextInput
                            id="title"
                            type="text"
                            class="form-control"
                            v-model="form.title"
                            autofocus
                            placeholder="Enter title"
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <span class="fw-bold">Seo</span>
                        </div>
                        <div class="card-body">

                            <div class="form-group pb-3">
                                <InputLabel class="pb-1" for="seoTitle" value="Seo Title" />
                                <TextInput
                                    id="seoTitle"
                                    type="text"
                                    class="form-control"
                                    v-model="form.seo_title"
                                    placeholder="Enter seo title"
                                />
                                <InputError class="mt-2" :message="form.errors.seo_title" />
                            </div>
                            <div class="form-group pb-3">
                                <InputLabel class="pb-1" for="seoDescription" value="Seo Description" />
                                <TextInput
                                    id="seoDescription"
                                    type="text"
                                    class="form-control"
                                    v-model="form.seo_description"
                                    placeholder="Enter seo description"
                                />
                                <InputError class="mt-2" :message="form.errors.seo_description" />
                            </div>
                            <div class="form-group pb-3">
                                <InputLabel class="pb-1" for="seoKeywords" value="Seo Keywords" />
                                <TextInput
                                    id="seoKeywords"
                                    type="text"
                                    class="form-control"
                                    v-model="form.seo_keywords"
                                    placeholder="Enter seo keywords"
                                />
                                <InputError class="mt-2" :message="form.errors.seo_keywords" />
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <span class="fw-bold">Body</span>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <InputLabel for="description" value="Description" />
                                <textarea v-model="form.description" class="form-control" id="description" rows="3"></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="form-group pb-4">
                                <InputLabel value="Text" />
                                <ckeditor name="text" :editor="editor" v-model="form.text" :config="editorConfig"></ckeditor>
                                <InputError class="mt-2" :message="form.errors.text" />
                            </div>

                        </div>
                    </div>

                    <div class="text-end pt-4">
                        <button type="submit" class="w-100 btn btn-success">Save</button>
                    </div>
                </form>

            </div>
            <div class="width-300">
                <CategoriesCard @categoryUpdated="onCategoryUpdated" />
                <LatestCard v-model="form.top" class="mt-4" />
                <FileCard class="mt-4" @fileChange="form.file = $event"
                          :fileAltMessage="form.errors.file_alt"
                          v-model:alt="form.file_alt" />
            </div>
        </div>

    </AuthenticatedLayout>
</template>
