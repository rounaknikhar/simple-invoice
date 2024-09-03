<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import CreateInvoiceLayout from "../_partials/CreateInvoiceLayout.vue";

const props = defineProps({
    invoice: Object,
});

const form = useForm({
    name: "",
    amount: "",
    unit: "",
    total_charge: "",
});

const submit = () => {
    form.post(
        route("invoice.create.show.store-products", {
            invoice: props.invoice.id,
        }),
        {
            preserveScroll: true,
            preserveState: false,
            onSuccess: () => productModal.close(),
        }
    );
};
</script>

<template>
    <CreateInvoiceLayout :step2="true">
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
        <dialog id="productModal" class="modal">
            <div class="modal-box w-11/12 max-w-2xl">
                <form method="dialog">
                    <button
                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                    >
                        ✕
                    </button>
                </form>
                <form @submit.prevent="submit" class="px-6">
                    <h3 class="text-lg font-bold">Add product</h3>
                    <div class="py-4">
                        <div class="grid grid-cols-1">
                            <label class="py-2 form-control w-full">
                                <div class="label">
                                    <span class="label-text"> Name </span>
                                </div>

                                <textarea
                                    v-model="form.name"
                                    placeholder="Add your product name within 100 characters"
                                    class="input input-bordered w-full overflow-x-hidden h-[150px]"
                                    maxlength="100"
                                ></textarea>
                                <span
                                    class="text-sm flex justify-end my-2"
                                    :class="
                                        form.name.length == 100
                                            ? 'text-error'
                                            : 'text-black'
                                    "
                                >
                                    {{ form.name.length }} / 100
                                </span>
                                <!-- Error message -->
                                <span
                                    v-if="form.errors?.name"
                                    class="label-text-alt text-red-600 my-2"
                                >
                                    {{ form.errors?.name }}
                                </span>
                            </label>

                            <label class="py-2 form-control w-full">
                                <div class="label">
                                    <span class="label-text">
                                        Amount
                                        <span class="text-red-600">*</span>
                                    </span>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    step=".01"
                                    v-model="form.amount"
                                    class="input input-bordered w-full"
                                    :class="
                                        form.errors?.amount
                                            ? 'border-red-600'
                                            : ''
                                    "
                                />
                                <!-- Error message -->
                                <span
                                    v-if="form.errors?.amount"
                                    class="label-text-alt text-red-600 my-2"
                                >
                                    {{ form.errors?.amount }}
                                </span>
                            </label>

                            <label class="py-2 form-control w-full">
                                <div class="label">
                                    <span class="label-text">
                                        Unit
                                        <span class="text-red-600">*</span>
                                    </span>
                                </div>
                                <input
                                    type="text"
                                    v-model="form.unit"
                                    class="input input-bordered w-full"
                                    :class="
                                        form.errors?.unit
                                            ? 'border-red-600'
                                            : ''
                                    "
                                />
                                <!-- Error message -->
                                <span
                                    v-if="form.errors?.unit"
                                    class="label-text-alt text-red-600 my-2"
                                >
                                    {{ form.errors?.unit }}
                                </span>
                            </label>

                            <label class="py-2 form-control w-full">
                                <div class="label">
                                    <span class="label-text">
                                        Total charge
                                        <span class="text-red-600">*</span>
                                    </span>
                                </div>
                                <input
                                    type="number"
                                    min="0"
                                    step=".01"
                                    v-model="form.total_charge"
                                    class="input input-bordered w-full"
                                    :class="
                                        form.errors?.total_charge
                                            ? 'border-red-600'
                                            : ''
                                    "
                                />
                                <!-- Error message -->
                                <span
                                    v-if="form.errors?.total_charge"
                                    class="label-text-alt text-red-600 my-2"
                                >
                                    {{ form.errors?.total_charge }}
                                </span>
                            </label>

                            <button
                                type="submit"
                                class="btn btn-primary mt-4"
                                :disabled="form.processing"
                                :class="!form.isDirty ? 'btn-disabled' : ''"
                            >
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </dialog>
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
                                <th class="font-semibold text-black">Amount</th>
                                <th class="font-semibold text-black">Unit</th>
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
                                <td class="font-semibold text-black">VAT %</td>
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
                                    invoice: props.invoice.id,
                                })
                            "
                        >
                            Finish
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </CreateInvoiceLayout>
</template>
