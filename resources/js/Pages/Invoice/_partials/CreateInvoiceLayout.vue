<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    step2: Boolean,
});
</script>
<template>
    <Head title="Create Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Invoice
            </h2>
        </template>

        <div class="max-w-7xl mx-auto pt-12 pb-4">
            <ul class="steps w-full mb-4" vue-auto-animate>
                <li class="step step-neutral">Invoice details</li>
                <li class="step" :class="step2 == true ? 'step-neutral' : ''">
                    Add products
                </li>
            </ul>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-base-100 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <slot />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
