<script setup>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import FileCard from '@/Components/Blog/File/Card.vue';
import CategoriesCard from '@/Components/Blog/Categories/Card.vue';
import SearchInput from '@/Components/Blog/Search/Input.vue';
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { usePage, Head, useForm } from '@inertiajs/vue3';
import SearchFoundAlert from '@/Components/Blog/Search/FoundAlert.vue';
import LatestCard from '@/Components/Blog/Latest/Card.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Flash from '@/Components/FlashSuccess.vue';
import FlashFail from '@/Components/FlashFail.vue';

const page = usePage()

const props = defineProps([
    'post', 'categories'
])

// console.log(props.post)

const form = useForm({
    title: props.post.title,
    seo_title: props.post.seo_title,
    seo_description: props.post.seo_description,
    seo_keywords: props.post.seo_keywords,
    description: props.post.description,
    text: props.post.text,
    categories: props.categories,
    top: Boolean(props.post.top),
    file: null,
    file_alt: props.post.file_alt ?? '',
    file_touched: false,
});


const submit = () => {
    form.transform((formData) => ({
        ...formData,
        _method: 'put',
    })).post(route('dashboard.post.update', {post: props.post.id}), {
        // onFinish: (e) => {
        //     // console.log(e)
        //     form.file_touched = false;
        // },
        onSuccess: (e) => {
            form.file_touched = false;
        },

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
}

</script>

<template>
    <Head title="Edit post" />

    <AuthenticatedLayout>
        <template #header>
            Posts
        </template>

        <div class="d-flex">
            <div class="flex-grow-1 pe-3">
                <Flash />
                <FlashFail />

                <form @submit.prevent="submit">

                    <div class="form-group pb-4">
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
                                    required
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
                        <button type="submit" class="w-100 btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
            <div class="width-300" style="flex: 0 0 300px;">
                <CategoriesCard :categories="categories" @categoryUpdated="onCategoryUpdated" />
                <LatestCard v-model="form.top" class="mt-4" />
                <FileCard class="mt-4" @fileChange="form.file = $event"
                          :edit="{
                              name: post.file_original_name,
                              path: post.path,
                          }"
                          :fileAltMessage="form.errors.file_alt"
                          v-model:alt="form.file_alt"
                          v-model:touched="form.file_touched"/>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
