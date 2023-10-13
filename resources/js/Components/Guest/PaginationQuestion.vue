<script setup>
import { router } from "@inertiajs/vue3";
import { pickBy } from "lodash";
import { reactive, watchEffect } from "vue";
import Emptynimation from "@/Animations/empty.json";
import ExamFinish from "@/Pages/Guest/ExamFinish.vue";

const props = defineProps({
    links: Object,
    filters: Object,
    member_exam_id: Number,
});

const data = reactive({
    params: {
        search: props.filters?.search,
        field: props.filters?.field,
        order: props.filters?.order,
        perPage: props.filters?.perPage,
        member_exam_id: props.member_exam_id,
    },
});

const goto = (link) => {
    let params = pickBy(data.params);
    router.get(link, params, {
        replace: true,
        preserveState: true,
    });
};

watchEffect(() => {
    data.params.search = props.filters?.search;
    data.params.field = props.filters?.field;
    data.params.order = props.filters?.order;
    data.params.perPage = props.filters?.perPage;
    data.params.member_exam_id = props.member_exam_id;
});
</script>
<template>
    <div class="ml-0" v-if="links.data.length != 0">
        {{ num(links.from) }} {{ lang().label.of }}
        {{ num(links.total) }}
    </div>
    <div
        class="flex flex-col space-y-2 mx-auto p-6 text-lg"
        v-if="links.data.length == 0"
    >
        <Vue3Lottie :animationData="Emptynimation" :height="250" :width="250" />
        <p class="text-center">{{ lang().label.no_data }}</p>
    </div>
    <div v-if="links.links.length > 3">
        <ul class="flex justify-center items-center rounded overflow-hidden">
            <li class="mr-2">
                <button
                    v-on:click="goto(links.prev_page_url)"
                    class="px-3 py-1.5 hover:bg-primary hover:text-white rounded border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary"
                    v-show="links.prev_page_url != null"
                >
                    Sebelumnya
                </button>
            </li>
            <li>
                <button
                    v-on:click="goto(links.next_page_url)"
                    class="px-3 py-1.5 hover:bg-primary hover:text-white border-slate-200 dark:border-slate-700 border rounded hover:border-primary dark:hover:border-primary"
                    v-show="links.next_page_url != null"
                >
                    Selanjutnya
                </button>
            </li>
            <li>
                <ExamFinish v-show="links.next_page_url == null" />
            </li>
        </ul>
    </div>
</template>
