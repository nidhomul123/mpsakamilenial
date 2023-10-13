<script setup>
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const emit = defineEmits(["open"]);
const show = ref(false);

const closeModal = () => {
    show.value = false;
};
</script>
<template>
    <div>
        <button
            class="px-3 py-1.5 bg-red-600 text-slate-50 hover:bg-red-500 hover:text-white border-slate-200 dark:border-slate-700 border rounded hover:border-red-500 dark:hover:border-red-500"
            @click.prevent="(show = true), emit('open')"
        >
            Selesai
        </button>
        <ConfirmationModal :show="show" @close="closeModal">
            <template #title> Selesaikan penilaian </template>

            <template #content>
                Apakah anda yakin akan menyelesaikan penilaian?
                <span class="font-black"
                    >Pastikan soal sudah terjawab semua</span
                >
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    {{ lang().button.cancel }}
                </SecondaryButton>

                <Link
                    :href="
                        route('guest.exam-end', {
                            memberExam: route().params.member_exam_id,
                        })
                    "
                >
                    <DangerButton class="ml-3"> Selesai </DangerButton>
                </Link>
            </template>
        </ConfirmationModal>
    </div>
</template>
