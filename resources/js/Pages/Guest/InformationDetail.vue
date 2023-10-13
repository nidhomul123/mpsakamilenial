<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {
    ChevronRightIcon,
    UserIcon,
    CalendarIcon,
} from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    title: String,
    information: Object,
    moreInformation: Object,
});
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
                            <p class="">{{ props.information?.user?.name }}</p>
                            <CalendarIcon class="ml-2 w-3 h-auto" />
                            <p class="">{{ props.information?.date_view }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="my-6 w-full block md:grid md:grid-cols-7 gap-10 space-y-6 md:space-y-0"
                >
                    <div class="col-span-5 space-y-4">
                        <img
                            class="rounded shadow"
                            :src="props.information?.full_path_image"
                            :alt="props.information?.title"
                        />
                        <p
                            class="no-tailwindcss-base"
                            v-html="props.information?.text"
                        ></p>
                    </div>
                    <div class="col-span-2 space-y-4">
                        <h1 class="text-xl font-semibold">
                            Informasi <span class="text-primary">Lainnya</span>
                        </h1>
                        <ul class="space-y-1">
                            <li
                                v-for="(
                                    moreInformation, index
                                ) in props.moreInformation"
                                :key="index"
                            >
                                <Link
                                    class="hover:text-primary"
                                    :href="
                                        route('guest.information-detail', {
                                            slug: moreInformation.slug,
                                        })
                                    "
                                >
                                    <div class="flex space-x-2">
                                        <ChevronRightIcon
                                            class="w-4 h-auto flex-shrink-0"
                                        />
                                        <p>{{ moreInformation.title }}</p>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
<style>
.ql-video {
    @apply w-full h-[500px];
}
</style>
