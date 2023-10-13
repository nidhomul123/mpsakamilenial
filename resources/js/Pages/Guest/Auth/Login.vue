<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/Guest/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    title: String
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("guest.member.handle-login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head :title="title" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="flex flex-col mb-4">
            <h2 class="text-primary font-semibold text-xl">
                {{ title }}
            </h2>
            <small class="text-slate-400">{{
                lang().label.login_caption
            }}</small>
        </div>
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :value="lang().label.email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    :placeholder="lang().placeholder.email"
                    autocomplete="username"
                    :error="form.errors.email"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" :value="lang().label.password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    :placeholder="lang().placeholder.password"
                    :message="form.errors.password"
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span
                        class="ml-2 text-sm text-slate-600 dark:text-slate-400"
                        >{{ lang().label.remember_me }}</span
                    >
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <span class="flex gap-1">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Belum Punya akun? Daftar</p>
                    <Link
                        :href="route('guest.member.register')"
                        class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-slate-800"
                    >
                        Di sini
                    </Link>
                </span>

                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ lang().button.login }} {{ form.processing ? "..." : "" }}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
