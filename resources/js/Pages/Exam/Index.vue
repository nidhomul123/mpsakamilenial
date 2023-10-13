<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Table from "@/Components/Table.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TablePagination from "@/Components/TablePagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Create from "@/Pages/Exam/Create.vue";
import Edit from "@/Pages/Exam/Edit.vue";
import Delete from "@/Pages/Exam/Delete.vue";
import DeleteBulk from "@/Pages/Exam/DeleteBulk.vue";
import { reactive, watch } from "vue";
import pkg from "lodash";
import { Link, router } from "@inertiajs/vue3";
import { ChevronUpDownIcon } from "@heroicons/vue/24/outline";
import Checkbox from "@/Components/Checkbox.vue";

const { _, debounce, pickBy } = pkg;
const props = defineProps({
    title: String,
    filters: Object,
    exams: Object,
    grades: Object,
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
    exam: null,
});

const order = (field) => {
    data.params.field = field;
    data.params.order = data.params.order === "asc" ? "desc" : "asc";
};

watch(
    () => _.cloneDeep(data.params),
    debounce(() => {
        let params = pickBy(data.params);
        router.get(route("exam.index"), params, {
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
        props.exams?.data.forEach((exam) => {
            data.selectedId.push(exam.id);
        });
    }
};
const select = () => {
    if (props.exams?.data.length == data.selectedId.length) {
        data.multipleSelect = true;
    } else {
        data.multipleSelect = false;
    }
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
                                <Create
                                    v-show="can(['exam create'])"
                                    :title="props.title"
                                    :grades="props.grades"
                                />
                                <DeleteBulk
                                    v-show="
                                        data.selectedId.length != 0 &&
                                        can(['exam delete'])
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
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('title')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Judul Penilaian</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4 text-center">Krida</th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('time')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Waktu</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('passing_grade')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Passing Grade</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('multiple_choice')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Pilgan</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('essay')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Essay</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('created_at')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span
                                            >{{
                                                lang().label.created
                                            }}
                                            Oleh</span
                                        >
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4 text-center sr-only">Action</th>
                            </tr>
                        </template>
                        <template #table-body>
                            <tr
                                v-for="(exam, index) in exams.data"
                                :key="index"
                                class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                            >
                                <td class="whitespace-nowrap px-4 py-2">
                                    <input
                                        class="rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox"
                                        @change="select"
                                        :value="exam.id"
                                        v-model="data.selectedId"
                                    />
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 text-center"
                                >
                                    {{ ++index }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ exam.title }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ exam.grade?.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ exam.time }} Menit
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ exam.passing_grade }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    <p>{{ exam.multiple_choice }} %</p>
                                    <Link
                                        v-tooltip="'Lihat/Input Soal'"
                                        class="text-primary hover:underline"
                                        :href="
                                            route('question.index', {
                                                type: 'Multiple Choice',
                                                exam_id: exam.id,
                                            })
                                        "
                                        ><small
                                            >{{
                                                exam.multiples.length
                                            }}
                                            Soal</small
                                        ></Link
                                    >
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    <p>{{ exam.essay }} %</p>
                                    <Link
                                        v-tooltip="'Lihat/Input Soal'"
                                        class="text-primary hover:underline"
                                        :href="
                                            route('question.index', {
                                                type: 'Essay',
                                                exam_id: exam.id,
                                            })
                                        "
                                        ><small
                                            >{{
                                                exam.essays.length
                                            }}
                                            Soal</small
                                        ></Link
                                    >
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    <small
                                        >{{ exam.user?.name }} <br />
                                        {{ exam.created_at }}
                                    </small>
                                </td>
                                <td
                                    class="whitespace-nowrap flex justify-end px-4 py-2"
                                >
                                    <div
                                        class="flex w-fit rounded overflow-hidden"
                                    >
                                        <Edit
                                            v-show="can(['exam update'])"
                                            :title="props.title"
                                            :exam="data.exam"
                                            :grades="props.grades"
                                            @open="data.exam = exam"
                                        />
                                        <Delete
                                            v-show="can(['exam delete'])"
                                            :title="props.title"
                                            :exam="data.exam"
                                            @open="data.exam = exam"
                                        />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template #table-pagination>
                            <TablePagination
                                :links="props.exams"
                                :filters="data.params"
                            />
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
