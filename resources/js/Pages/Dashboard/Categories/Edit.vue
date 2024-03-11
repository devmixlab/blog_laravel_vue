<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Flash from '@/Components/FlashSuccess.vue';
import FlashFail from '@/Components/FlashFail.vue';

const props = defineProps([
    'resource'
])

const form = useForm({
    title: props.resource.title,
});

const submit = () => {
    // page.props.flash.success = false;
    form.transform((formData) => ({
        ...formData,
        _method: 'put',
    })).post(route('dashboard.category.update', {tag: props.resource.id}), {
        // onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <Head title="Edit category" />

    <AuthenticatedLayout>
        <template #header>
            Posts
        </template>

        <div>
            <Flash />
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

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>

    </AuthenticatedLayout>
</template>
