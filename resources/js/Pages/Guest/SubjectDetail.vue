<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import {
    ChevronRightIcon,
    UserIcon,
    CalendarIcon,
} from "@heroicons/vue/24/outline";
import { Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Delete from "@/Pages/Comment/Delete.vue";
import { ref } from "vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { usePage } from "@inertiajs/vue3";
const props = defineProps({
    title: String,
    subject: Object,
    moreSubject: Object,
});
const form = useForm({
    text: "",
    subject_id: props.subject?.id,
    member_id: usePage().props.app.member?.id,
});
const text = ref();
const submit = () => {
    form.post(route("comment.store"), {
        preserveScroll: true,
        onSuccess: () => text.value.setHTML(""),
        onError: () => null,
        onFinish: () => null,
    });
};
</script>
<template>
    <GuestLayout :title="props.title">
        <section class="bg-white min-h-[calc(100vh-64px)] dark:bg-slate-900">
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
                class="max-w-7xl mx-auto items-center px-4 sm:px-6 lg:px-8 pt-20 pb-8"
            >
                <div
                    class="w-full block md:grid md:grid-cols-7 gap-10 space-y-6 md:space-y-0"
                >
                    <div class="col-span-5">
                        <p class="text-2xl font-semibold">{{ props.title }}</p>
                        <div
                            class="flex justify-start items-center gap-1 text-sm"
                        >
                            <UserIcon class="w-3 h-auto" />
                            <p class="">{{ props.subject?.user?.name }}</p>
                            <CalendarIcon class="ml-2 w-3 h-auto" />
                            <p class="">{{ props.subject?.created_at }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="my-6 w-full block md:grid md:grid-cols-7 gap-10 space-y-6 md:space-y-0"
                >
                    <div class="col-span-5 space-y-4">
                        <img
                            class="rounded shadow"
                            :src="props.subject?.full_path_image"
                            :alt="props.subject?.title"
                        />
                        <div
                            class="no-tailwindcss-base"
                            v-html="props.subject?.subject"
                        ></div>
                    </div>
                    <div class="col-span-2 space-y-4">
                        <h1 class="text-xl font-semibold">
                            Materi <span class="text-primary">Lainnya</span>
                        </h1>
                        <ul class="space-y-1">
                            <li
                                v-for="(
                                    moreSubject, index
                                ) in props.moreSubject"
                                :key="index"
                            >
                                <Link
                                    class="hover:text-primary"
                                    :href="
                                        route('guest.subject-detail', {
                                            slug: moreSubject.slug,
                                        })
                                    "
                                >
                                    <div class="flex space-x-2">
                                        <ChevronRightIcon
                                            class="w-4 h-auto flex-shrink-0"
                                        />
                                        <p>{{ moreSubject.title }}</p>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div
                    class="my-4 py-4 space-y-4 border-t border-slate-300 dark:border-slate-700"
                >
                    <h1 class="text-lg font-bold">
                        Komentar ({{ props.subject?.comments.length }})
                    </h1>
                    <div
                        v-for="(comment, index) in props.subject?.comments"
                        :key="index"
                    >
                        <div class="flex gap-2 items-start" v-if="comment.user">
                            <img
                                :src="comment.user.profile_photo_url"
                                :alt="comment.user.name"
                                class="rounded-full h-10 w-10 object-cover"
                            />
                            <div class="flex flex-col">
                                <div class="flex gap-2 items-center">
                                    <p class="font-bold">
                                        {{ comment.user.name }}
                                    </p>
                                    <p class="text-sm">
                                        {{ comment.created_at }}
                                    </p>
                                </div>
                                <div
                                    class="no-tailwindcss-base"
                                    v-html="comment.text"
                                ></div>
                            </div>
                        </div>
                        <div
                            class="flex gap-2 items-start"
                            v-if="comment.member"
                        >
                            <img
                                :src="comment.member.full_path_image"
                                :alt="comment.member.name"
                                class="rounded-full h-10 w-10 object-cover"
                            />
                            <div class="flex flex-col">
                                <div class="flex gap-2 items-center">
                                    <p class="font-bold">
                                        {{ comment.member.name }}
                                    </p>
                                    <p class="text-sm">
                                        {{ comment.created_at }}
                                    </p>
                                    <Delete
                                        v-show="
                                            comment.member_id ===
                                            $page.props.app.member.id
                                        "
                                        :comment="comment"
                                    />
                                </div>
                                <div
                                    class="no-tailwindcss-base"
                                    v-html="comment.text"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <form class="space-y-2" @submit.prevent="submit">
                        <div class="space-y-2">
                            <div class="space-y-1">
                                <QuillEditor
                                    id="text"
                                    ref="text"
                                    :style="'border: none'"
                                    v-model:content="form.text"
                                    theme="snow"
                                    toolbar="essential"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.text" />
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                @click="submit"
                            >
                                Kirim
                                {{ form.processing ? "..." : "" }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<style>
.ql-editor {
    @apply h-[100px] border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-primary focus:border-2 dark:focus:border-primary focus:ring-primary dark:focus:ring-primary rounded shadow-sm placeholder:text-slate-300 dark:placeholder:text-slate-700;
}
.ql-toolbar.ql-snow {
    @apply rounded border-slate-300 dark:text-slate-100 dark:border-slate-700 dark:bg-slate-900;
}
.ql-tooltip {
    left: 0 !important;
}
.ql-video {
    @apply w-full h-[500px];
}
</style>
