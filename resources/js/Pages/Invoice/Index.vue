<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InvoicesTable from '../../Components/InvoicesTable.vue';

defineProps({
    invoices: {
        type: Object,
    },
});
</script>

<template>

    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <InvoicesTable :invoices="invoices" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>