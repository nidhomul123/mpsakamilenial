<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Layouts/Authenticated/Breadcrumb.vue";
import {
    BookOpenIcon,
    BuildingLibraryIcon,
    NewspaperIcon,
    UsersIcon,
} from "@heroicons/vue/24/outline";
import { reactive } from "vue";
import { Bar, Doughnut } from "vue-chartjs";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    Colors,
    ArcElement,
} from "chart.js";

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    Colors,
    ArcElement
);

const props = defineProps({
    members: Number,
    grades: Number,
    subjects: Number,
    informations: Number,
    kridas: Object,
    statuses: Object,
});

const data = reactive({
    chartData: {
        labels: props.kridas?.map((d) => d.grade),
        datasets: [
            {
                data: props.kridas?.map((d) => d.count),
                backgroundColor: [
                    "#37a2eb",
                    "#4cc0c0",
                    "#fe6484",
                    "#f59e0c",
                    "#4387f5",
                ],
            },
        ],
    },
    chartData2: {
        labels: ["Terdaftar", "Diterima", "Ditolak"],
        datasets: [
            {
                data: [
                    props.statuses[0]?.terdaftar,
                    props.statuses[0]?.diterima,
                    props.statuses[0]?.ditolak,
                ],
                backgroundColor: ["#37a2eb", "#4cc0c0", "#fe6484"],
            },
        ],
    },
    chartOptions: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            colors: {
                enabled: true,
            },
            legend: {
                display: false,
            },
        },
    },
    chartOptions2: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            colors: {
                enabled: true,
            },
        },
    },
});
</script>

<template>
    <AppLayout :title="lang().label.dashboard">
        <template #title>
            <span>{{ lang().label.dashboard }}</span>
        </template>
        <template #breadcrumb>
            <Breadcrumb />
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 lg:grid-cols-4 gap-4"
                >
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-sky-500 flex m-2 rounded justify-center items-center"
                        >
                            <UsersIcon class="w-12 h-auto text-white" />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                Anggota Diterima
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.members) }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-emerald-500 flex m-2 rounded justify-center items-center"
                        >
                            <BuildingLibraryIcon
                                class="w-12 h-auto text-white"
                            />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                Krida
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.grades) }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-amber-500 flex m-2 rounded justify-center items-center"
                        >
                            <BookOpenIcon class="w-12 h-auto text-white" />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                Materi
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.subjects) }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded text-slate-800 dark:text-slate-200 flex gap-4"
                    >
                        <div
                            class="w-24 h-24 bg-rose-500 flex m-2 rounded justify-center items-center"
                        >
                            <NewspaperIcon class="w-12 h-auto text-white" />
                        </div>
                        <div class="flex flex-col justify-center items-start">
                            <p class="truncate font-semibold max-w-full">
                                Informasi
                            </p>
                            <p class="text-3xl font-semibold text-primary">
                                {{ num(props.informations) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded p-4 space-y-2"
                >
                    <p class="font-bold">Grafik Member</p>
                    <div
                        class="block lg:flex items-center gap-8 lg:gap-4 bg-white p-4 rounded"
                    >
                        <div class="w-full lg:w-3/4">
                            <p class="text-slate-800 text-center font-bold">
                                Per Krida
                            </p>
                            <Bar
                                id="my-chart-id"
                                :options="data.chartOptions"
                                :data="data.chartData"
                            />
                        </div>
                        <div class="w-full lg:w-1/4">
                            <p class="text-slate-800 text-center font-bold">
                                Per Status
                            </p>
                            <Doughnut
                                id="my-chart-id"
                                :options="data.chartOptions2"
                                :data="data.chartData2"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
