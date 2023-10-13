<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    title: String,
    memberexam: Object,
    breadcrumbs: Object,
});
const form = useForm({
    multiple_choice: props.memberexam?.exam_answers
        .filter((d) => d.question.type == "Multiple Choice")
        .map((d) => ({
            id: d.id,
            score: String(d.score),
            type: d.question.type,
            question: d.question.question,
            key: d.question.key,
            answer: d.answer,
        })),
    essay: props.memberexam?.exam_answers
        .filter((d) => d.question.type == "Essay")
        .map((d) => ({
            id: d.id,
            score: String(d.score),
            type: d.question.type,
            question: d.question.question,
            answer: d.answer,
        })),
});
const submit = () => {
    form.post(route("memberexam.save-correction"), {
        preserveScroll: true,
        onSuccess: () => null,
        onError: () => null,
        onFinish: () => null,
    });
};
</script>

<template>
    <AppLayout :title="props.title">
        <template #title>
            <span>{{ props.title }}</span>
        </template>
        <template #breadcrumb>
            <Breadcrumb />
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                <div
                    class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded space-y-4"
                >
                    <div class="space-y-2">
                        <h1 class="pt-4 pl-4 font-semibold">
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
                                    v-for="(
                                        question, index
                                    ) in form.multiple_choice"
                                    :key="index"
                                    class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                                >
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-center"
                                    >
                                        {{ ++index }}
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
                                        v-html="question.key"
                                    ></td>
                                    <td
                                        class="px-4 py-2"
                                        v-html="question.answer"
                                    ></td>
                                    <td class="whitespace-nowrap px-4 py-2">
                                        <TextInput
                                            class="w-20"
                                            placeholder="nilai"
                                            type="number"
                                            min="0"
                                            max="10"
                                            v-model="
                                                form.multiple_choice[index - 1]
                                                    .score
                                            "
                                        />
                                    </td>
                                </tr>
                            </template>
                            <template #table-pagination> </template>
                        </Table>
                    </div>
                    <div class="space-y-2">
                        <h1 class="pl-4 font-semibold">
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
                                    v-for="(question, i) in form.essay"
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
                                        <TextInput
                                            class="w-20"
                                            placeholder="nilai"
                                            type="number"
                                            min="0"
                                            max="10"
                                            v-model="form.essay[i - 1].score"
                                        />
                                    </td>
                                </tr>
                            </template>
                            <template #table-pagination>
                                <div class="flex w-full justify-end">
                                    <PrimaryButton
                                        class="ml-3"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                        @click="submit"
                                    >
                                        {{ lang().button.save }}
                                        {{ form.processing ? "..." : "" }}
                                    </PrimaryButton>
                                </div>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
