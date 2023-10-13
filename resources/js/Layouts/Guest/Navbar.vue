<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavbarLink from "@/Components/Guest/NavbarLink.vue";
import SwitchDarkMode from "@/Components/SwitchDarkMode.vue";
import { Bars3BottomRightIcon, UserIcon } from "@heroicons/vue/24/solid";
import { reactive } from "vue";
import { ChevronDownIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const data = reactive({
    isOpen: false,
    fixed: false,
});

window.addEventListener("scroll", () => {
    let scrollPos = window.scrollY;
    if (scrollPos > 0) {
        data.fixed = true;
    } else {
        data.fixed = false;
    }
});
const logout = () => {
    router.post(route("guest.member.logout"));
};
</script>
<template>
    <header
        v-bind:class="
            data.fixed || data.isOpen
                ? 'bg-white/70 dark:bg-slate-900/70 backdrop-blur-lg border-b border-slate-300/50 dark:border-slate-700/50'
                : 'border-none'
        "
        class="w-full fixed text-slate-600 dark:text-slate-200 z-50"
    >
        <div
            class="flex flex-col max-w-7xl px-4 mx-auto sm:items-center sm:justify-between sm:flex-row sm:px-6 lg:px-8 py-2"
        >
            <div class="flex items-center justify-between">
                <div>
                    <Link
                        :href="route('index')"
                        class="shrink-0 flex w-full justify-start items-center space-x-4"
                    >
                        <ApplicationLogo class="block h-8 w-auto" />
                        <p
                            class="text-lg font-semibold uppercase tracking-widest"
                        >
                            {{ $page.props.app.setting.short_name }}
                        </p>
                    </Link>
                </div>
                <div class="sm:hidden">
                    <SwitchDarkMode />
                    <button
                        @click="data.isOpen = !data.isOpen"
                        class="inline-flex items-center justify-center p-2 rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out"
                    >
                        <Bars3BottomRightIcon
                            v-if="!data.isOpen"
                            class="w-6 h-auto"
                        />
                        <XMarkIcon v-else class="w-6 h-auto" />
                    </button>
                </div>
            </div>
            <nav
                :class="data.isOpen ? '' : 'hidden'"
                class="relative sm:flex items-center space-y-2 sm:space-y-0 gap-2 py-4 sm:py-0"
            >
                <NavbarLink
                    v-bind:class="
                        route().current('index') ? 'font-bold text-primary' : ''
                    "
                    :href="route('index')"
                    label="Beranda"
                />
                <NavbarLink
                    v-bind:class="
                        route().current('guest.information') ||
                        route().current('guest.information-detail')
                            ? 'font-bold text-primary'
                            : ''
                    "
                    :href="route('guest.information')"
                    label="Informasi"
                />
                <NavbarLink
                    v-show="$page.props.app.member"
                    v-bind:class="
                        route().current('guest.subject') ||
                        route().current('guest.subject-detail')
                            ? 'font-bold text-primary'
                            : ''
                    "
                    :href="route('guest.subject')"
                    label="Materi"
                />
                <NavbarLink
                    v-show="$page.props.app.member"
                    v-bind:class="
                        route().current('guest.exam') ||
                        route().current('guest.exam-index')
                            ? 'font-bold text-primary'
                            : ''
                    "
                    :href="route('guest.exam')"
                    label="Penilaian"
                />
                <NavbarLink
                    v-show="!$page.props.app.member"
                    :href="route('guest.member.login')"
                    label="Masuk/Daftar"
                />
                <!-- Settings Dropdown -->
                <div v-show="$page.props.app.member" class="relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <div
                                class="inline-flex items-center sm:justify-center p-2 rounded hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 transition duration-150 ease-in-out w-full gap-2 justify-between"
                            >
                                <button
                                    v-bind:class="
                                        route().current('guest.member') ||
                                        route().current('guest.exam-result')
                                            ? 'font-bold text-primary'
                                            : ''
                                    "
                                    class="max-w-[100px] truncate"
                                >
                                    {{ $page.props.app.member?.name }}
                                </button>
                                <ChevronDownIcon class="w-4 h-4" />
                            </div>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div
                                class="block px-4 py-2 truncate border-b border-slate-200 dark:border-slate-600"
                            >
                                <div class="flex items-center">
                                    <p>{{ $page.props.app.member?.name }}</p>
                                </div>
                                <div class="block text-xs truncate">
                                    {{ $page.props.app.member?.email }}
                                </div>
                            </div>
                            <div class="block px-4 py-2 text-xs text-slate-400">
                                {{ lang().label.manage_account }}
                            </div>

                            <DropdownLink :href="route('guest.exam-result')">
                                Hasil Penilaian
                            </DropdownLink>

                            <DropdownLink :href="route('guest.member')">
                                {{ lang().label.profile }}
                            </DropdownLink>

                            <div
                                class="border-t border-slate-200 dark:border-slate-600"
                            />

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    {{ lang().label.logout }}
                                </DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>
                <SwitchDarkMode class="hidden sm:block" />
            </nav>
        </div>
    </header>
</template>
