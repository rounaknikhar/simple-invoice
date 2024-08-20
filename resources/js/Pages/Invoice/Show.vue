<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EditInvoiceModal from './_partials/EditInvoiceModal.vue';

defineProps({
    invoice: {
        type: Object,
    },
});
</script>

<template>

    <Head title="Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoice</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <button class="btn" onclick="editInvoiceModal.showModal()">Edit Invoice</button>
                    <EditInvoiceModal :invoice="invoice" />
                    <pre>
                {{ invoice }}
            </pre>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>