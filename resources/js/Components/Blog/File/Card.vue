<script setup>
import { ref, reactive, computed, watch } from 'vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps([
    'fileAltMessage', 'edit'
]);
const emit = defineEmits(["fileChange"])

const input = ref(null);
const image = ref(null);

let rData = reactive({image: null});

if(props.edit?.name || props.edit?.path){
    rData.image = {
        name: props.edit?.name ?? null,
            src: props.edit?.path ?? null,
    }
}

// console.log(props.edit.path)

const altModel = defineModel('alt');
const touchedModel = defineModel('touched');
// let files;
// if(files)
//     touch();
// console.log(altModel)

function onFileChange(e) {
    touch();
    const files = e.target.files;
    if(!files.length)
        return;

    const file = files[0];
    input.value.value = null;

    const fileReader = new FileReader();
    fileReader.onload = event => {
        // image.value.style.backgroundImage = "url('" + event.target.result + "')";
        rData.image = {
            name: file.name,
            src: event.target.result,
        }
        emit("fileChange", file);
    }
    fileReader.readAsDataURL(file);
}

function onAddImage() {
    if(!rData.image)
        input.value.click()
}

function onRemoveImage() {
    touch();
    rData.image = null;
    altModel.value = '';
    emit("fileChange", null);
}

function touch() {
    if(!touchedModel.value)
        touchedModel.value = true;
}

</script>

<style lang="scss">
    .file-upload{
        input[type=file]{
            position: absolute;
            opacity: 0;
            top: -5000000px;
        }
        .article-image{
            position: relative;
            height: 200px;
            background-color: #f1f1f1;
            border-radius: 5px;
            color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 60px;
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            -webkit-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.1);
            -moz-box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.1);
            box-shadow: 2px 2px 5px 1px rgba(0,0,0,0.1);
            &.picked{
                cursor: initial;
            }
            .inner{
                span{
                    font-size: 14px;
                    padding-left: 10px;
                }
            }
        }
    }
</style>

<template>

    <div class="card">
        <div class="card-header">
            <span class="fw-bold">Image</span>
            <button @click="onAddImage" v-if="!rData.image" class="btn btn-primary btn-sm float-end">Add</button>
            <button @click.stop="onRemoveImage" v-else class="btn btn-danger btn-sm float-end">Remove</button>
        </div>
        <div class="card-body">
            <div class="file-upload">
                <input @change="onFileChange" ref="input" type="file">

                <div class="form-group pb-3">
                    <InputLabel class="pb-1" for="imageAlt" value="Alt tag of image" />
                    <TextInput
                        id="imageAlt"
                        type="text"
                        class="form-control"
                        v-model="altModel"
                        placeholder="Enter text ..."
                    />
                    <InputError class="mt-2" :message="fileAltMessage" />
                </div>

<!--                <input v-model="touchedModel" type="checkbox" />-->

                <div :class="{
                    picked: rData.image,
                }" :style="{
                    'background-image': rData.image?.src ?
                        'url(' + rData.image.src + ')' : null,
                }" ref="image" @click="onAddImage" class="article-image">
                    <div class="inner" v-if="!rData.image">
                        <i class="bi bi-image"></i>
                        <span>Pick an image</span>
                    </div>
                </div>

                <div v-if="rData.image?.name" class="pt-2 text-center">
                    {{rData.image.name}}
                </div>
            </div>
        </div>
    </div>

</template>
