<script setup>
import SwitchDarkMode from "@/Components/SwitchDarkMode.vue";
import Banner from "@/Components/Banner.vue";
import Toast from "@/Components/Toast.vue";
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    maxWidth: {
        default: "md",
        type: String,
    },
});
const maxWidthClass = computed(() => {
    return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
        "3xl": "sm:max-w-3xl",
        "4xl": "sm:max-w-4xl",
        "5xl": "sm:max-w-5xl",
        "6xl": "sm:max-w-6xl",
        "7xl": "sm:max-w-7xl",
    }[props.maxWidth];
});
</script>
<template>
    <Toast :flash="$page.props.flash" />
    <Banner />
    <div
        class="min-h-screen flex flex-col justify-center items-center pt-0 bg-slate-100 dark:bg-slate-900 space-y-4"
    >
        <div
            :class="maxWidthClass"
            class="w-full bg-white my-4 dark:bg-slate-800 shadow overflow-hidden sm:rounded sm:grid"
        >
            <div class="px-6 py-8 space-y-4">
                <div class="w-full flex justify-between items-center">
                    <Link href="/" class="flex justify-start items-center space-x-2">
                        <slot name="logo" />
                        <p class="text-slate-600 dark:text-slate-400 text-xl">
                            {{ $page.props.app.setting.short_name }}
                        </p>
                    </Link>
                    <div class="flex justify-between items-center gap-1">
                        <SwitchDarkMode />
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
