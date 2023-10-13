<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import Table from "@/Components/Table.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { onUpdated, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: Number,
    memberexam: Object,
});

const form = useForm({
    answers: null,
});
onUpdated(() => {
    if (show) {
        form.answers = props.memberexam.exam_answers
            .filter((d) => d.question.type == "Essay")
            .map((d) => ({
                id: d.id,
                score: String(d.score),
                type: d.question.type,
                question: d.question.question,
                answer: d.answer,
            }));
    }
});

const submit = () => {
    form.put(route("memberexam.update", props.memberexam?.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => null,
        onFinish: () => null,
    });
};
const closeModal = () => {
    show.value = false;
};
const score = (memberexam) => {
    let sum = 0;
    memberexam.exam_answers.forEach((d) => {
        if (d.question.type == "Multiple Choice") {
            sum += Number(d.score);
        }
    });
    return sum;
};
const sumEssay = () => {
    let sum = 0;
    form.answers?.forEach((d) => {
        sum += Number(d.score);
    });
    return sum;
};
</script>
<template>
    <div>
        <p
            v-tooltip="'Detail Penilaian'"
            class="text-bold cursor-pointer hover:underline hover:text-primary"
            @click.prevent="(show = true), emit('open')"
        >
            {{ props.title }}
        </p>
        <DialogModal :show="show" @close="closeModal" maxWidth="5xl">
            <template #title> Detail Penilaian </template>
            <template #content>
                <div class="space-y-4">
                    <div class="space-y-2">
                        <h1>
                            Pilihan Ganda Bobot
                            {{ props.memberexam.exam?.multiple_choice }}%
                        </h1>
                        <Table>
                            <template #table-head>
                                <tr>
                                    <th class="p-4 text-center">#</th>
                                    <th class="p-4 text-left">Soal</th>
                                    <th class="p-4 text-left">Jenis</th>
                                    <th class="p-4 text-left">Kunci</th>
                                    <th class="p-4 text-left">Jawaban</th>
                                    <th class="p-4 text-center">Nilai</th>
                                </tr>
                            </template>
                            <template #table-body>
                                <tr
                                    v-for="(exam_answer, index) in props
                                        .memberexam?.exam_answers"
                                    :key="index"
                                    class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                                    v-show="
                                        exam_answer.question?.type ==
                                        'Multiple Choice'
                                    "
                                >
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-center"
                                    >
                                        {{ ++index }}
                                    </td>
                                    <td
                                        class="px-4 py-2"
                                        v-html="exam_answer.question?.question"
                                    ></td>
                                    <td class="whitespace-nowrap px-4 py-2">
                                        Pilihan Ganda
                                    </td>
                                    <td
                                        class="px-4 py-2 text-center uppercase"
                                        v-html="exam_answer.question.key"
                                    ></td>
                                    <td
                                        class="px-4 py-2 text-center uppercase"
                                        v-html="exam_answer.answer"
                                    ></td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-center"
                                    >
                                        <p>
                                            {{
                                                exam_answer.score
                                            }}
                                        </p>
                                    </td>
                                </tr>
                            </template>
                            <template #table-pagination>
                                <p class="font-bold">Total Nilai</p>
                                <p class="font-bold mr-3">
                                    {{ score(props.memberexam) }}
                                </p>
                            </template>
                        </Table>
                    </div>
                    <div class="space-y-2">
                        <h1>
                            Essay Bobot
                            {{ props.memberexam.exam?.essay }}%
                        </h1>
                        <Table>
                            <template #table-head>
                                <tr>
                                    <th class="p-4 text-center">#</th>
                                    <th class="p-4 text-left">Soal</th>
                                    <th class="p-4 text-left">Jenis</th>
                                    <th class="p-4 text-left">Jawaban</th>
                                    <th class="p-4 text-center">Nilai</th>
                                </tr>
                            </template>
                            <template #table-body>
                                <tr
                                    v-for="(
                                        question, i
                                    ) in props.memberexam.exam_answers
                                        .filter(
                                            (d) => d.question.type == 'Essay'
                                        )
                                        .map((d) => ({
                                            id: d.id,
                                            score: String(d.score),
                                            type: d.question.type,
                                            question: d.question.question,
                                            answer: d.answer,
                                        }))"
                                    :key="i"
                                    class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                                >
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-center"
                                    >
                                        {{ ++i }}
                                    </td>
                                    <td
                                        class="px-4 py-2"
                                        v-html="question.question"
                                    ></td>
                                    <td class="whitespace-nowrap px-4 py-2">
                                        Essay
                                    </td>
                                    <td
                                        class="px-4 py-2"
                                        v-html="question.answer"
                                    ></td>
                                    <td class="whitespace-nowrap px-4 py-2">
                                        
                                    <td
                                    class="whitespace-nowrap px-4 py-2 text-center"
                                >
                                    <p>
                                        {{
                                            question.score
                                        }}
                                    </p>
                                </td>
                                    </td>
                                </tr>
                            </template>
                            <template #table-pagination>
                                <p class="font-bold">Total Nilai</p>
                                <p class="font-bold mr-4">
                                    {{ sumEssay() }}
                                </p>
                            </template>
                        </Table>
                    </div>
                </div>
            </template>
            <template #footer>
                <SecondaryButton @click="closeModal">
                    {{ lang().button.cancel }}
                </SecondaryButton>
            </template>
        </DialogModal>
    </div>
</template>
