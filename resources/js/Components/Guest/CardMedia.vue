<script setup>
import {
    CalendarDaysIcon,
    ChatBubbleOvalLeftIcon,
    EyeIcon,
    UserIcon,
} from "@heroicons/vue/24/outline";
import { Link } from "@inertiajs/vue3";
defineProps({
    href: String,
    image: String,
    title: String,
    username: String,
    date: String,
    description: {
        type: String,
        default: null,
    },
    comment: {
        type: Number,
        default: null,
    },
});
</script>
<template>
    <Link
        data-aos="zoom-in-up"
        data-aos-duration="1000"
        :href="href"
        class="group rounded overflow-hidden shadow bg-white dark:bg-slate-700/50"
    >
        <img
            class="group-hover:scale-110 w-full h-64 object-cover object-center transition-all duration-500 ease-in-out transform"
            :src="image"
            alt="Sunset in the mountains"
        />
        <div class="px-6 py-4">
            <div class="group-hover:text-primary font-bold text-xl line-clamp-1">
                {{ title }}
            </div>
            <div class="flex justify-start items-center gap-1 text-sm mb-2">
                <UserIcon class="w-3 h-auto" />
                <p class="">{{ username }}</p>
                <CalendarDaysIcon class="ml-2 w-3 h-auto" />
                <p class="">
                    {{ date }}
                </p>
                <ChatBubbleOvalLeftIcon
                    v-show="comment"
                    class="ml-2 w-3 h-auto"
                />
                <p v-show="comment" class="">
                    {{ comment }}
                </p>
            </div>
            <p class="line-clamp-2" v-show="description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum
                ipsam tenetur a asperiores, nostrum dolorum obcaecati ab
                dignissimos itaque temporibus iure modi perferendis minus minima
                hic nesciunt cupiditate id explicabo?
            </p>
        </div>
    </Link>
</template>
