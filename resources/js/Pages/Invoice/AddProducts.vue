<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AddProductsModal from "./_partials/AddProductsModal.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    invoice: Object,
});
</script>

<template>
    <Head title="Add products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add products Invoice#{{ invoice.id }}
            </h2>
        </template>

        <AddProductsModal :invoice="invoice" />

        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex md:justify-between justify-end p-12">
                    <span v-if="invoice.products.length == 0"
                        >Please add your first product</span
                    >
                    <button
                        class="btn btn-sm btn-primary text-white rounded shadow-xl"
                        onclick="productModal.showModal()"
                    >
                        <span>Add product</span>
                    </button>
                </div>

                <div>
                    <!-- Invoiced products -->
                    <div v-if="invoice.products.length > 0" class="px-12 pb-12">
                        <span
                            class="font-semibold text-lg border-l-2 border-primary p-1 pl-3 mt-4"
                        >
                            Invoiced products
                        </span>
                        <div class="overflow-x-auto py-4">
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th class="font-semibold text-black">
                                            Product
                                        </th>
                                        <th class="font-semibold text-black">
                                            Amount
                                        </th>
                                        <th class="font-semibold text-black">
                                            Unit
                                        </th>
                                        <th class="font-semibold text-black">
                                            Total charge
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="product in invoice.products"
                                        :key="product.id"
                                    >
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.amount }}</td>
                                        <td>{{ product.unit }}</td>
                                        <td>{{ product.total_charge }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold text-black">
                                            Sub total
                                        </td>
                                        <th></th>
                                        <th></th>
                                        <th class="font-semibold text-black">
                                            {{ invoice.sub_total }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold text-black">
                                            VAT %
                                        </td>
                                        <th></th>
                                        <th></th>
                                        <th class="font-semibold text-black">
                                            {{ invoice.vat_percentage }}%
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="font-semibold text-black">
                                            Grand total
                                        </td>
                                        <th></th>
                                        <th></th>
                                        <th class="font-semibold text-black">
                                            {{ invoice.total }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex justify-end">
                                <Link
                                    class="btn btn-primary mt-4 w-full md:w-56 text-white"
                                    :href="
                                        route('invoice.show', {
                                            invoice: invoice.id,
                                        })
                                    "
                                >
                                    Finish
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
