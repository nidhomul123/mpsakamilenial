<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ActionButton from "@/Components/ActionButton.vue";
import Table from "@/Components/Table.vue";
import TablePagination from "@/Components/TablePagination.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { ChevronUpDownIcon } from "@heroicons/vue/24/outline";
import { reactive, watch } from "vue";
import pkg from "lodash";
import { Link, router } from "@inertiajs/vue3";

const { _, debounce, pickBy } = pkg;
const props = defineProps({
    title: String,
    exams: Object,
    filters: Object,
    perPage: Number,
});

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
});
const order = (field) => {
    data.params.field = field;
    data.params.order = data.params.order === "asc" ? "desc" : "asc";
};

watch(
    () => _.cloneDeep(data.params),
    debounce(() => {
        let params = pickBy(data.params);
        router.get(route("guest.exam"), params, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }, 150)
);
</script>
<template>
    <GuestLayout :title="props.title">
        <section class="min-h-[calc(100vh)]">
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
                class="max-w-7xl mx-auto items-center px-4 sm:px-6 lg:px-8 pt-20 pb-8 space-y-4"
            >
                <div class="w-full block md:flex justify-between">
                    <div class="block">
                        <p class="text-2xl font-semibold uppercase">
                            {{ props.title }}
                        </p>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded"
                >
                    <Table>
                        <template #table-action>
                            <div
                                class="flex shrink-0 rounded overflow-hidden"
                            ></div>
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
                                <th class="p-4 text-left">Krida</th>
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
                                <th class="p-4 text-center sr-only">Action</th>
                            </tr>
                        </template>
                        <template #table-body>
                            <tr
                                v-for="(exam, index) in exams.data"
                                :key="index"
                                class="border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"
                            >
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
                                    {{ exam.multiples.length }} Soal
                                </td>
                                <td
                                    class="whitespace-nowrap px-4 py-2 max-w-xs truncate"
                                >
                                    {{ exam.essays.length }} Soal
                                </td>
                                <td
                                    class="whitespace-nowrap flex justify-end px-4 py-2"
                                >
                                    <div
                                        class="flex w-fit rounded overflow-hidden"
                                    >
                                        <Link
                                            :href="
                                                route('guest.exam-start', {
                                                    slug: exam.slug,
                                                })
                                            "
                                        >
                                            <ActionButton
                                                variant="info"
                                                class="rounded"
                                                >Mulai</ActionButton
                                            ></Link
                                        >
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
        </section>
    </GuestLayout>
</template>
