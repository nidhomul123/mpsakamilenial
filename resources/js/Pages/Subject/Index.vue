<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Table from "@/Components/Table.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TablePagination from "@/Components/TablePagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Create from "@/Pages/Subject/Create.vue";
import Edit from "@/Pages/Subject/Edit.vue";
import Delete from "@/Pages/Subject/Delete.vue";
import DeleteBulk from "@/Pages/Subject/DeleteBulk.vue";
import { reactive, watch } from "vue";
import pkg from "lodash";
import { Link, router } from "@inertiajs/vue3";
import {
    ChatBubbleOvalLeftIcon,
    ChevronUpDownIcon,
} from "@heroicons/vue/24/outline";
import Checkbox from "@/Components/Checkbox.vue";

const { _, debounce, pickBy } = pkg;
const props = defineProps({
    title: String,
    filters: Object,
    subjects: Object,
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
    subject: null,
});

const order = (field) => {
    data.params.field = field;
    data.params.order = data.params.order === "asc" ? "desc" : "asc";
};

watch(
    () => _.cloneDeep(data.params),
    debounce(() => {
        let params = pickBy(data.params);
        router.get(route("subject.index"), params, {
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
        props.subjects?.data.forEach((subject) => {
            data.selectedId.push(subject.id);
        });
    }
};
const select = () => {
    if (props.subjects?.data.length == data.selectedId.length) {
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
                                    v-show="can(['subject create'])"
                                    :title="props.title"
                                    :grades="props.grades"
                                />
                                <DeleteBulk
                                    v-show="
                                        data.selectedId.length != 0 &&
                                        can(['subject delete'])
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
                                    v-on:click="order('name')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>{{ lang().label.name }}</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th
                                    class="p-4 cursor-pointer"
                                    v-on:click="order('description')"
                                >
                                    <div
                                        class="flex justify-between items-center"
                                    >
                                        <span>Deskripsi</span>
                                        <ChevronUpDownIcon class="w-4 h-4" />
                                    </div>
                                </th>
                                <th class="p-4 text-center">Krida</th>
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
                                v-for="(subject, index) in subjects.data"
                                :key="index"
                                class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                            >
                                <td class="whitespace-nowrap px-4 py-2">
                                    <input
                                        class="rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary"
                                        type="checkbox"
                                        @change="select"
                                        :value="subject.id"
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
                                    <div class="flex space-x-2 items-center">
                                        <img
                                            class="w-10 h-10 object-cover rounded"
                                            :src="subject.full_path_image"
                                            :alt="subject.title"
                                        />
                                        <div>
                                            <p class="max-w-[200px] truncate">
                                                {{ subject.title }}
                                            </p>
                                            <Link
                                                v-tooltip="
                                                    'Klik untuk melihat komentar'
                                                "
                                                class="flex items-center gap-1 text-sm"
                                                :href="
                                                    route('subject.show', {
                                                        subject: subject.id,
                                                    })
                                                "
                                            >
                                                <ChatBubbleOvalLeftIcon
                                                    class="w-4 h-auto"
                                                /><span
                                                    v-if="!subject.comments"
                                                    class="text-primary underline"
                                                    >Belum ada komentar</span
                                                ><span
                                                    v-else
                                                    class="text-primary underline"
                                                    >{{
                                                        subject.comments.length
                                                    }}
                                                    komentar</span
                                                ></Link
                                            >
                                        </div>
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ subject.description }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ subject.grade?.name }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ subject.created_at }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    {{ subject.user?.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap flex justify-end px-4 py-2"
                                >
                                    <div
                                        class="flex w-fit rounded overflow-hidden"
                                    >
                                        <Edit
                                            v-show="can(['subject update'])"
                                            :title="props.title"
                                            :subject="data.subject"
                                            :grades="props.grades"
                                            @open="data.subject = subject"
                                        />
                                        <Delete
                                            v-show="can(['subject delete'])"
                                            :title="props.title"
                                            :subject="data.subject"
                                            @open="data.subject = subject"
                                        />
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template #table-pagination>
                            <TablePagination
                                :links="props.subjects"
                                :filters="data.params"
                            />
                        </template>
                    </Table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
