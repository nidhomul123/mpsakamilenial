<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Table from "@/Components/Table.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import WarningButton from "@/Components/WarningButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TablePagination from "@/Components/TablePagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Create from "@/Pages/Question/Create.vue";
import Edit from "@/Pages/Question/Edit.vue";
import Delete from "@/Pages/Question/Delete.vue";
import DeleteBulk from "@/Pages/Question/DeleteBulk.vue";
import { reactive, watch } from "vue";
import pkg from "lodash";
import { Link, router } from "@inertiajs/vue3";
import { ChevronLeftIcon, ChevronUpDownIcon } from "@heroicons/vue/24/outline";
import Checkbox from "@/Components/Checkbox.vue";

const { _, debounce, pickBy } = pkg;
const props = defineProps({
    title: String,
    filters: Object,
    questions: Object,
    breadcrumbs: Object,
    perPage: Number,
    type: String,
    exam_id: Number,
});

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
        type: props.type,
        exam_id: props.exam_id,
    },
    selectedId: [],
    multipleSelect: false,
    question: null,
});

const order = (field) => {
    data.params.field = field;
    data.params.order = data.params.order === "asc" ? "desc" : "asc";
};

watch(
    () => _.cloneDeep(data.params),
    debounce(() => {
        let params = pickBy(data.params);
        router.get(route("question.index"), params, {
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
        props.questions?.data.forEach((question) => {
            data.selectedId.push(question.id);
        });
    }
};
const select = () => {
    if (props.questions?.data.length == data.selectedId.length) {
        data.multipleSelect = true;
    } else {
        data.multipleSelect = false;
    }
};
</script>

<template>
    <AppLayout
        :title="
            props.title +
            ' ' +
            (route().params.type == 'Multiple Choice'
                ? 'Pilihan Ganda'
                : 'Essay')
        "
    >
        <template #title>
            <span>{{
                props.title +
                " " +
                (route().params.type == "Multiple Choice"
                    ? "Pilihan Ganda"
                    : "Essay")
            }}</span>
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
                                <Link :href="route('exam.index')">
                                    <WarningButton
                                        class="flex rounded-none items-center justify-start gap-2"
                                    >
                                        <ChevronLeftIcon class="w-4 h-auto" />
                                        <span class="hidden md:block"
                                            >Kembali</span
                                        >
                                    </WarningButton></Link
                                >
                                <Create
                                    v-show="can(['question create'])"
                                    :title="props.title"
                                />
                                <DeleteBulk
                                    v-show="
                                        data.selectedId.length != 0 &&
                                        can(['question delete'])
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
                                    v-on:click="order('question')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Soal</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('type')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Jenis</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    v-show="
                                        route().params.type == 'Multiple Choice'
                                    "
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('key')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Kunci Jawaban</span>
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
                                        <span>{{ lang().label.created }}</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4 text-left">
                                    {{ lang().label.by }}
                                </th>
                                <th class="p-4 text-center sr-only">Action</th>
                            </tr>
                        </template>
                        <template #table-body>
                            <tr
                                v-for="(question, index) in questions.data"
                                :key="index"
                                class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                            >
                                <td class="whitespace-nowrap px-4 py-2">
                                    <input
                                        class="rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox"
                                        @change="select"
                                        :value="question.id"
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
                                    v-html="question.question"
                                ></td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{
                                        question.type == "Multiple Choice"
                                            ? "Pilihan Ganda"
                                            : "Essay"
                                    }}
                                </td>
                                <td
                                    v-show="
                                        route().params.type == 'Multiple Choice'
                                    "
                                    class="whitespace-nowrap px-4 py-2 uppercase"
                                >
                                    {{ question.key }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ question.created_at }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ question.user?.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap flex justify-end px-4 py-2"
                                >
                                    <div
                                        class="flex w-fit rounded overflow-hidden"
                                    >
                                        <Edit
                                            v-show="can(['question update'])"
                                            :title="props.title"
                                            :question="data.question"
                                            @open="data.question = question"
                                        />
                                        <Delete
                                            v-show="can(['question delete'])"
                                            :title="props.title"
                                            :question="data.question"
                                            @open="data.question = question"
                                        />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template #table-pagination>
                            <TablePagination
                                :links="props.questions"
                                :filters="data.params"
                            />
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
