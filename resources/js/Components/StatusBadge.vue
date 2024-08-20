<script setup>
defineProps({
    statusObject: {
        type: Object,
    },
});

</script>

<template>
    <div class="badge bg-green-500 text-white" v-if="statusObject.id === 2">
        {{ statusObject.name }}
    </div>
    <div class="badge bg-light text-secondary" v-else-if="statusObject.id === 3">
        {{ statusObject.name }}
    </div>
    <div class="badge bg-accent text-white" v-else>
        {{ statusObject.name }}
    </div>
</template>