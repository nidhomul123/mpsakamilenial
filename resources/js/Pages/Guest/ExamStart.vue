<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PaginationQuestion from "@/Components/Guest/PaginationQuestion.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref, watch, watchEffect } from "vue";

const props = defineProps({
    title: String,
    exam: Object,
    questions: Object,
    question_maps: Object,
    studentExam: Object,
    seconds: Number,
});
// Initialize variables
const minutes = ref(Math.floor(props.seconds / 60));
const seconds = ref(props.seconds % 60);
let timer;

// Variable with the initial number of seconds (3650 seconds)
const initialSeconds = 3650;

// Function to convert seconds to minutes and seconds
const convertSecondsToMinutesAndSeconds = (totalSeconds) => {
    const mins = Math.floor(totalSeconds / 60);
    const secs = totalSeconds % 60;
    return { mins, secs };
};
// console.log(
//     route("guest.exam-end", {
//         memberExam: route().params.member_exam_id,
//     })
// );
// Function to start the countdown
const startCountdown = () => {
    let remainingSeconds = props.seconds;

    // Update the countdown timer every second
    timer = setInterval(() => {
        if (remainingSeconds < 0) {
            clearInterval(timer);
            window.location = route("guest.exam-end", {
                memberExam: route().params.member_exam_id,
            });
        } else {
            const { mins, secs } =
                convertSecondsToMinutesAndSeconds(remainingSeconds);
            minutes.value = mins;
            seconds.value = secs;
            remainingSeconds--;
        }
    }, 1000);
};

// Start the countdown when the component is mounted
onMounted(() => {
    startCountdown();
});

const form = useForm({
    member_exam_id: props.studentExam?.id,
    question_id: props.questions.data[0]?.question_id,
    answer: props.questions.data[0]?.answer,
});
watchEffect(() => {
    form.member_exam_id = props.studentExam?.id;
    form.question_id = props.questions.data[0]?.question_id;
    form.answer = props.questions.data[0]?.answer;

    return () => {
        clearInterval(timer);
    };
});
const submit = () => {
    form.post(route("guest.exam-save"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => null,
        onFinish: () => (form.answer = props.questions.data[0]?.answer),
    });
};
</script>
<template>
    <GuestLayout :title="props.title">
        <section class="min-h-[calc(100vh)]">
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
                class="max-w-7xl mx-auto items-center px-4 sm:px-6 lg:px-8 pt-20 pb-8 space-y-4"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="space-y-4 col-span-2">
                        <div class="w-full block md:flex justify-between">
                            <div class="block">
                                <p class="text-2xl font-semibold uppercase">
                                    {{ props.title }}
                                </p>
                            </div>
                        </div>
                        <div
                            v-for="(question, index) in questions.data"
                            :key="index"
                            class="block space-y-4"
                        >
                            <p class="uppercase">Pertanyaan</p>
                            <p
                                class="no-tailwindcss-base text-2xl"
                                v-html="question.question.question"
                            ></p>
                            <p class="uppercase">Jawaban</p>
                            <div
                                class="space-y-2"
                                v-if="
                                    question.question.type == 'Multiple Choice'
                                "
                            >
                                <div class="flex">
                                    <input
                                        :checked="question.answer == 'a'"
                                        type="radio"
                                        name="answer"
                                        v-model="form.answer"
                                        value="a"
                                        class="shrink-0 mt-0.5 border-slate-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-slate-800"
                                        id="answer-a"
                                    />
                                    <label
                                        for="answer-a"
                                        class="flex items-center space-x-1 text-slate-500 ml-3 dark:text-slate-200"
                                    >
                                        <p>A.</p>
                                        <p v-html="question.question.a"></p
                                    ></label>
                                </div>
                                <div class="flex">
                                    <input
                                        :checked="question.answer == 'b'"
                                        type="radio"
                                        name="answer"
                                        v-model="form.answer"
                                        value="b"
                                        class="shrink-0 mt-0.5 border-slate-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-slate-800"
                                        id="answer-b"
                                    />
                                    <label
                                        for="answer-b"
                                        class="flex items-center space-x-1 text-slate-500 ml-3 dark:text-slate-200"
                                    >
                                        <p>B.</p>
                                        <p v-html="question.question.b"></p
                                    ></label>
                                </div>
                                <div class="flex">
                                    <input
                                        :checked="question.answer == 'c'"
                                        type="radio"
                                        name="answer"
                                        v-model="form.answer"
                                        value="c"
                                        class="shrink-0 mt-0.5 border-slate-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-slate-800"
                                        id="answer-c"
                                    />
                                    <label
                                        for="answer-c"
                                        class="flex items-center space-x-1 text-slate-500 ml-3 dark:text-slate-200"
                                    >
                                        <p>C.</p>
                                        <p v-html="question.question.c"></p
                                    ></label>
                                </div>
                                <div class="flex">
                                    <input
                                        :checked="question.answer == 'd'"
                                        type="radio"
                                        name="answer"
                                        v-model="form.answer"
                                        value="d"
                                        class="shrink-0 mt-0.5 border-slate-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-slate-800"
                                        id="answer-d"
                                    />
                                    <label
                                        for="answer-d"
                                        class="flex items-center space-x-1 text-slate-500 ml-3 dark:text-slate-200"
                                    >
                                        <p>D.</p>
                                        <p v-html="question.question.d"></p
                                    ></label>
                                </div>
                                <div class="flex">
                                    <input
                                        :checked="question.answer == 'e'"
                                        type="radio"
                                        name="answer"
                                        v-model="form.answer"
                                        value="e"
                                        class="shrink-0 mt-0.5 border-slate-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-slate-800"
                                        id="answer-e"
                                    />
                                    <label
                                        for="answer-e"
                                        class="flex items-center space-x-1 text-slate-500 ml-3 dark:text-slate-200"
                                    >
                                        <p>E.</p>
                                        <p v-html="question.question.e"></p
                                    ></label>
                                </div>
                                <InputError :message="form.errors.answer" />
                            </div>

                            <div class="space-y-2" v-else>
                                <textarea
                                    v-model="form.answer"
                                    v-bind:class="
                                        form.errors.answer
                                            ? 'border-rose-500 dark:border-rose-400 dark:bg-slate-900 dark:text-slate-300 focus:border-rose-500 dark:focus:border-rose-400 focus:ring-rose-500 dark:focus:ring-rose-400 '
                                            : 'border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-primary dark:focus:border-primary focus:ring-primary dark:focus:ring-primary '
                                    "
                                    class="block w-full rounded shadow-sm placeholder:text-slate-300 dark:placeholder:text-slate-700"
                                    rows="5"
                                ></textarea>
                                <InputError :message="form.errors.answer" />
                            </div>
                            <div class="flex justify-start items-center">
                                <PrimaryButton
                                    @click="submit"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    >Simpan
                                    {{
                                        form.processing ? "..." : ""
                                    }}</PrimaryButton
                                >
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <PaginationQuestion
                                :links="questions"
                                :member_exam_id="props.studentExam.id"
                            />
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="text-6xl my-4 text-red-500 font-bold">
                            {{ minutes }}:{{ seconds }}
                        </p>
                        <p class="text-md font-semibold uppercase">Peta Soal</p>
                        <div class="space-y-2">
                            <p>Pilihan Ganda</p>
                            <div class="grid grid-cols-6 gap-2">
                                <Link
                                    :href="
                                        route('guest.exam-index', {
                                            slug: props.exam?.slug,
                                            member_exam_id:
                                                props.studentExam.id,
                                            page: index + 1,
                                        })
                                    "
                                    v-for="(
                                        question_map, index
                                    ) in props.question_maps"
                                    :key="index"
                                    v-show="
                                        question_map.question.type ==
                                        'Multiple Choice'
                                    "
                                    v-bind:class="
                                        (route().params.page == null &&
                                            index + 1 == 1) ||
                                        route().params.page == index + 1
                                            ? 'bg-primary text-slate-50'
                                            : question_map.answer != null
                                            ? 'bg-green-500 text-slate-50'
                                            : 'bg-slate-300 dark:bg-slate-600'
                                    "
                                    class="h-12 flex justify-center items-center rounded"
                                >
                                    {{ index + 1 }}
                                </Link>
                            </div>
                            <p>Essay</p>
                            <div class="grid grid-cols-6 gap-2">
                                <Link
                                    :href="
                                        route('guest.exam-index', {
                                            slug: props.exam?.slug,
                                            member_exam_id:
                                                props.studentExam.id,
                                            page: index + 1,
                                        })
                                    "
                                    v-for="(
                                        question_map, index
                                    ) in props.question_maps"
                                    :key="index"
                                    v-show="
                                        question_map.question.type == 'Essay'
                                    "
                                    v-bind:class="
                                        (route().params.page == null &&
                                            index + 1 == 1) ||
                                        route().params.page == index + 1
                                            ? 'bg-primary text-slate-50'
                                            : question_map.answer != null
                                            ? 'bg-green-500 text-slate-50'
                                            : 'bg-slate-300 dark:bg-slate-600'
                                    "
                                    class="h-12 flex justify-center items-center rounded"
                                >
                                    {{ index + 1 }}
                                </Link>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <h1>Keterangan</h1>
                            <div class="flex space-x-1 items-center">
                                <div
                                    class="w-5 h-5 rounded bg-slate-300 dark:bg-slate-600"
                                ></div>
                                <p>Belum Dijawab</p>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <div class="w-5 h-5 rounded bg-green-500"></div>
                                <p>Sudah Dijawab</p>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <div class="w-5 h-5 rounded bg-primary"></div>
                                <p>Soal Terpilih</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
