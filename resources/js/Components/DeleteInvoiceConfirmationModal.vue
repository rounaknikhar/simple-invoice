<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
const page = usePage();
const props = defineProps({
    invoice: {
        type: Number,
    },
});
const form = useForm({
    invoice: props.invoice,
});

const submit = () => {
    form.delete(
        route("invoice.product.delete", {
            invoice: form.invoice,
        }),
        {
            preserveScroll: true,
            preserveState: false,
            onSuccess: () => {
                deleteInvoiceModal.close();
                toast.success(page.props.flash.message);
            },
        }
    );
};
</script>
<template>
    <dialog :id="deleteInvoiceModal" class="modal">
        <div class="modal-box">
            <div role="alert" class="alert alert-warning">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0 stroke-current"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                    />
                </svg>
                <span>Warning: Are you sure you want to delete this?</span>
            </div>
            <form @submit.prevent="submit">
                <div class="pt-4 md:flex md:justify-end">
                    <button
                        type="submit"
                        class="btn btn-error w-full text-white md:w-auto"
                    >
                        Delete
                    </button>
                </div>
            </form>
        </div>

        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>
