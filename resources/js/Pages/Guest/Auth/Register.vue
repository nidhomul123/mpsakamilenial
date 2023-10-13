<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/Guest/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import ImageInput from "@/Components/ImageInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";

const props = defineProps({
    title: String,
    grades: Object,
});

const form = useForm({
    grade_id: props.grades[0]?.id,
    name: "",
    image: null,
    card: null,
    email: "",
    gender: "L",
    birth_place: "",
    birth_date: "",
    gudep: "",
    kwarran: "Pekalongan Barat",
    number_id: "",
    level: "Penegak",
    address: "",
    phone: "",
    instagram: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("guest.member.handle-register"), {
        onFinish: () => form.reset("password"),
    });
};
const genders = [
    { label: "Laki-laki", value: "L" },
    { label: "Perempuan", value: "P" },
];
const kwarrans = [
    { label: "Pekalongan Barat", value: "Pekalongan Barat" },
    { label: "Pekalongan Timur", value: "Pekalongan Timur" },
    { label: "Pekalongan Selatan", value: "Pekalongan Selatan" },
    { label: "Pekalongan Utara", value: "Pekalongan Utara" },
];
const levels = [
    { label: "Penegak", value: "Penegak" },
    { label: "Penegak Bantara", value: "Penegak Bantara" },
    { label: "Penegak Laksana", value: "Penegak Laksana" },
    { label: "Penegak Garuda", value: "Penegak Garuda" },
    { label: "Pandega", value: "Pandega" },
    { label: "Pandega Garuda", value: "Pandega Garuda" },
    { label: "Partisipan", value: "Partisipan" },
];
const grades = props.grades?.map((grade) => ({
    label: grade.name,
    value: grade.id,
}));
const fileChange = (value) => {
    if (value.source == "image") {
        form.image = value.file;
    } else if (value.source == "card") {
        form.card = value.file;
    }
};
</script>

<template>
    <Head :title="title" />

    <AuthenticationCard maxWidth="5xl">
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="flex flex-col mb-4">
            <h2 class="text-primary font-semibold text-xl">
                {{ title }}
            </h2>
            <small class="text-slate-400">{{
                lang().label.register_caption
            }}</small>
        </div>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="space-y-1">
                        <InputLabel for="name" value="Pas Foto" />
                        <ImageInput
                            class="w-full h-56"
                            source="image"
                            @fileChange="fileChange"
                        />
                        <InputError :message="form.errors.image" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="name" value="Nama Lengkap" />
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="block w-full"
                            autocomplete="name"
                            placeholder="Nama Lengkap"
                            :error="form.errors.name"
                        />
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="block w-full"
                            autocomplete="email"
                            placeholder="Email"
                            :error="form.errors.email"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="gender" value="Jenis Kelamin" />
                        <SelectInput
                            class="block w-full"
                            v-model="form.gender"
                            :dataSet="genders"
                        />
                        <InputError :message="form.errors.gender" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="space-y-1">
                            <InputLabel
                                for="birth_place"
                                value="Tempat Lahir"
                            />
                            <TextInput
                                id="birth_place"
                                v-model="form.birth_place"
                                type="text"
                                class="block w-full"
                                autocomplete="birth_place"
                                placeholder="Tempat Lahir"
                                :error="form.errors.birth_place"
                            />
                            <InputError :message="form.errors.birth_place" />
                        </div>
                        <div class="space-y-1">
                            <InputLabel
                                for="birth_date"
                                value="Tanggal Lahir"
                            />
                            <TextInput
                                id="birth_date"
                                v-model="form.birth_date"
                                type="date"
                                class="block w-full"
                                autocomplete="birth_date"
                                placeholder="Tanggal Lahir"
                                :error="form.errors.birth_date"
                            />
                            <InputError :message="form.errors.birth_date" />
                        </div>
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="address" value="Alamat Lengkap" />
                        <TextAreaInput
                            id="address"
                            v-model="form.address"
                            class="block w-full"
                            rows="2"
                            placeholder="Alamat Lengkap"
                            :error="form.errors.address"
                        />
                        <InputError :message="form.errors.address" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="phone" value="Nomor Telepon" />
                        <TextInput
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="block w-full"
                            autocomplete="phone"
                            placeholder="Nomor Telepon"
                            :error="form.errors.phone"
                        />
                        <InputError :message="form.errors.phone" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="instagram" value="Akun Instagram" />
                        <TextInput
                            id="instagram"
                            v-model="form.instagram"
                            type="text"
                            class="block w-full"
                            autocomplete="instagram"
                            placeholder="@username"
                            :error="form.errors.instagram"
                        />
                        <InputError :message="form.errors.instagram" />
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="space-y-1">
                        <InputLabel for="gudep" value="Pangkalan/Gudep" />
                        <TextInput
                            id="gudep"
                            v-model="form.gudep"
                            type="text"
                            class="block w-full"
                            autocomplete="gudep"
                            placeholder="Pangkalan/Gudep"
                            :error="form.errors.gudep"
                        />
                        <InputError :message="form.errors.gudep" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="kwarran" value="Kwarran" />
                        <SelectInput
                            class="block w-full"
                            v-model="form.kwarran"
                            :dataSet="kwarrans"
                        />
                        <InputError :message="form.errors.kwarran" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="number_id"
                            value="NTA Pramuka/NIS/NIM"
                        />
                        <TextInput
                            id="number_id"
                            v-model="form.number_id"
                            type="text"
                            class="block w-full"
                            autocomplete="number_id"
                            placeholder="NTA Pramuka/NIS/NIM"
                            :error="form.errors.number_id"
                        />
                        <InputError :message="form.errors.number_id" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="level" value="Tingkatan Pramuka" />
                        <SelectInput
                            class="block w-full"
                            v-model="form.level"
                            :dataSet="levels"
                        />
                        <InputError :message="form.errors.level" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="grade_id"
                            value="Krida Saka Milenial"
                        />
                        <SelectInput
                            class="block w-full"
                            v-model="form.grade_id"
                            :dataSet="grades"
                        />
                        <InputError :message="form.errors.grade_id" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="card"
                            value="KTA/Kartu Pelajar/Kartu Mahasiswa/KTP"
                        />
                        <ImageInput
                            class="w-full h-60"
                            source="card"
                            @fileChange="fileChange"
                        />
                        <InputError :message="form.errors.card" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="password" value="Kata Sandi" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="block w-full"
                            autocomplete="password"
                            placeholder="Kata Sandi"
                            :error="form.errors.password"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="password_confirmation"
                            value="Konfirmasi Kata Sandi"
                        />
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="block w-full"
                            autocomplete="password_confirmation"
                            placeholder="Konfirmasi Kata Sandi"
                            :error="form.errors.password_confirmation"
                        />
                        <InputError
                            :message="form.errors.password_confirmation"
                        />
                    </div>
                    <div class="block pt-2">
                        <label class="flex items-center gap-2">
                            <Checkbox required name="disclaimer" />
                            <span
                                class="ml-2 text-sm text-slate-600 dark:text-slate-400"
                                >Dengan ini, saya meyatakan keinginan menjadi
                                anggota saka milenial secara sukarela</span
                            >
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <span class="flex gap-1">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Sudah Punya akun?</p>
                    <Link
                        :href="route('guest.member.login')"
                        class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-slate-800"
                    >
                        Masuk
                    </Link>
                </span>

                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ lang().button.register }}
                    {{ form.processing ? "..." : "" }}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
