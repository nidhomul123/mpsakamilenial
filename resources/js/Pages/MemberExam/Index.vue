<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ActionButton from "@/Components/ActionButton.vue";
import Table from "@/Components/Table.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TablePagination from "@/Components/TablePagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Score from "@/Pages/MemberExam/Score.vue";
import Delete from "@/Pages/MemberExam/Delete.vue";
import DeleteBulk from "@/Pages/MemberExam/DeleteBulk.vue";
import { reactive, watch } from "vue";
import pkg from "lodash";
import { Link, router } from "@inertiajs/vue3";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/24/outline";
import Checkbox from "@/Components/Checkbox.vue";

const { _, debounce, pickBy } = pkg;
const props = defineProps({
    title: String,
    filters: Object,
    memberexams: Object,
    breadcrumbs: Object,
    perPage: Number,
});

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
    selectedId: [],
    multipleSelect: false,
    memberexam: null,
});

const order = (field) => {
    data.params.field = field;
    data.params.order = data.params.order === "asc" ? "desc" : "asc";
};
watch(
    () => _.cloneDeep(data.params),
    debounce(() => {
        let params = pickBy(data.params);
        router.get(route("memberexam.index"), params, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }, 150)
);

const selectAll = (event) => {
    if (event.target.checked === false) {
        data.selectedId = [];
    } else {
        props.memberexams?.data.forEach((memberexam) => {
            data.selectedId.push(memberexam.id);
        });
    }
};
const select = () => {
    if (props.memberexams?.data.length == data.selectedId.length) {
        data.multipleSelect = true;
    } else {
        data.multipleSelect = false;
    }
};
const score = (memberexam) => {
    let score = 0;
    let multiple_choice_score = 0;
    let essay_score = 0;
    const multiple_choice = memberexam.exam?.multiple_choice;
    const essay = memberexam.exam?.essay;
    let multiple_choice_count = 0;
    memberexam.exam_answers?.forEach((answer) => {
        if (answer.question?.type == "Multiple Choice") {
            multiple_choice_score += answer.score;
            multiple_choice_count++;
        } else {
            essay_score += answer.score;
        }
    });
    multiple_choice_score = (multiple_choice_score * multiple_choice) / 100;
    essay_score = (essay_score * essay) / 100;
    score = multiple_choice_score + essay_score;
    return score;
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
                    class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded"
                >
                    <Table>
                        <template #table-action>
                            <div class="flex shrink-0 rounded overflow-hidden">
                                <DeleteBulk
                                    v-show="
                                        data.selectedId.length != 0 &&
                                        can(['memberexam delete'])
                                    "
                                    :selectedId="data.selectedId"
                                    :title="props.title"
                                    @close="
                                        (data.selectedId = []),
                                            (data.multipleSelect = false)
                                    "
                                />
                            </div>
                            <div class="flex justify-end items-center gap-2">
                                <div class="flex space-x-2">
                                    <SelectInput
                                        class="h-9 text-sm"
                                        v-model="data.params.perPage"
                                        :dataSet="$page.props.app.perpage"
                                    />
                                </div>
                                <TextInput
                                    v-model="data.params.search"
                                    type="text"
                                    class="block h-9"
                                    :placeholder="lang().placeholder.search"
                                />
                            </div>
                        </template>
                        <template #table-head>
                            <tr>
                                <th class="p-4 text-left">
                                    <Checkbox
                                        v-model:checked="data.multipleSelect"
                                        @change="selectAll"
                                    />
                                </th>
                                <th class="p-4 text-center">#</th>
                                <th class="p-4 text-left">
                                    Nama Anggota/Krida
                                </th>
                                <th class="p-4 text-left">Judul Penilaian</th>
                                <th class="p-4 text-left">Pasing Grade</th>
                                <th class="p-4 text-center">Nilai</th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('created_at')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Tanggal</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4 text-center sr-only">Action</th>
                            </tr>
                        </template>
                        <template #table-body>
                            <tr
                                v-for="(memberexam, index) in memberexams.data"
                                :key="index"
                                class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                            >
                                <td class="whitespace-nowrap px-4 py-2">
                                    <input
                                        class="rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox"
                                        @change="select"
                                        :value="memberexam.id"
                                        v-model="data.selectedId"
                                    />
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 text-center"
                                >
                                    {{ ++index }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ memberexam.member?.name }} <br />
                                    <small>{{
                                        memberexam.member?.grade?.name
                                    }}</small>
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ memberexam.exam?.title }} <br />
                                    Pilgan :
                                    {{ memberexam.exam?.multiple_choice }}%.
                                    Essay : {{ memberexam.exam?.essay }}%
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 text-center"
                                >
                                    {{ memberexam.exam?.passing_grade }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 text-center"
                                >
                                    <Score
                                        v-if="can(['memberexam correction'])"
                                        :title="score(memberexam)"
                                        :memberexam="data.memberexam"
                                        @open="data.memberexam = memberexam"
                                    />
                                    <p v-else>{{ score(memberexam) }}</p>
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ memberexam.created_at }}
                                </td>
                                <td
                                    class="whitespace-nowrap flex justify-end px-4 py-2"
                                >
                                    <div
                                        class="flex w-fit rounded overflow-hidden"
                                    >
                                        <Link
                                            v-show="
                                                can(['memberexam correction'])
                                            "
                                            :href="
                                                route('memberexam.correction', {
                                                    memberExam: memberexam.id,
                                                })
                                            "
                                        >
                                            <ActionButton
                                                v-tooltip="'Koreksi Jawaban'"
                                                variant="info"
                                            >
                                                <CheckIcon
                                                    class="w-4 h-auto"
                                                /> </ActionButton
                                        ></Link>
                                        <Delete
                                            v-show="can(['memberexam delete'])"
                                            :title="props.title"
                                            :memberexam="data.memberexam"
                                            @open="data.memberexam = memberexam"
                                        />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template #table-pagination>
                            <TablePagination
                                :links="props.memberexams"
                                :filters="data.params"
                            />
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
