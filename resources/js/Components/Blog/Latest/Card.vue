<script setup>
const model = defineModel()

</script>

<template>

    <div class="card">
        <div class="card-header">
            <span class="fw-bold">Top article</span>
        </div>
        <div class="card-body">
            <div class="form-check form-switch">
                <input v-model="model" class="form-check-input" type="checkbox" id="topSwitchCheck">
                <label class="form-check-label" for="topSwitchCheck">Set as top article</label>
            </div>
        </div>
    </div>

</template>
