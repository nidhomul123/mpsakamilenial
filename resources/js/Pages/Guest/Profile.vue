<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ImageInput from "@/Components/ImageInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";

const props = defineProps({
    title: String,
    member: Object,
    grades: Object,
});
const form = useForm({
    grade_id: props.member?.grade_id,
    name: props.member?.name,
    image: null,
    card: null,
    email: props.member?.email,
    gender: props.member?.gender,
    birth_place: props.member?.birth_place,
    birth_date: props.member?.birth_date,
    gudep: props.member?.gudep,
    kwarran: props.member?.kwarran,
    number_id: props.member?.number_id,
    level: props.member?.level,
    address: props.member?.address,
    phone: props.member?.phone,
    instagram: props.member?.instagram,
    password: "",
    password_confirmation: "",
    _method: "PUT",
});
const data = reactive({
    image: props.member?.full_path_image,
    card: props.member?.full_path_card,
});
const submit = () => {
    form.post(route("guest.member-update", props.member?.id), {
        preserveScroll: true,
        onSuccess: () => null,
        onError: () => null,
        onFinish: () => null,
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
    <GuestLayout :title="props.title">
        <section class="min-h-[calc(100vh)]" id="home">
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
                class="max-w-7xl mx-auto items-center px-4 sm:px-6 lg:px-8 pt-20 pb-8 space-y-4"
            >
                <div class="w-full block md:flex justify-between">
                    <div class="block">
                        <p class="text-2xl font-semibold uppercase">
                            {{ props.title }}
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <form class="space-y-4" @submit.prevent="submit">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="space-y-1">
                                    <InputLabel for="name" value="Pas Foto" />
                                    <ImageInput
                                        class="w-full h-56"
                                        source="image"
                                        @fileChange="fileChange"
                                        :image="data.image"
                                    />
                                    <InputError :message="form.errors.image" />
                                </div>
                                <div class="space-y-1">
                                    <InputLabel
                                        for="name"
                                        value="Nama Lengkap"
                                    />
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
                                    <InputLabel
                                        for="gender"
                                        value="Jenis Kelamin"
                                    />
                                    <SelectInput
                                        class="block w-full"
                                        v-model="form.gender"
                                        :dataSet="genders"
                                    />
                                    <InputError :message="form.errors.gender" />
                                </div>
                                <div
                                    class="grid grid-cols-1 sm:grid-cols-2 gap-2"
                                >
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
                                        <InputError
                                            :message="form.errors.birth_place"
                                        />
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
                                        <InputError
                                            :message="form.errors.birth_date"
                                        />
                                    </div>
                                </div>
                                <div class="space-y-1">
                                    <InputLabel
                                        for="address"
                                        value="Alamat Lengkap"
                                    />
                                    <TextAreaInput
                                        id="address"
                                        v-model="form.address"
                                        class="block w-full"
                                        rows="2"
                                        placeholder="Alamat Lengkap"
                                        :error="form.errors.address"
                                    />
                                    <InputError
                                        :message="form.errors.address"
                                    />
                                </div>
                                <div class="space-y-1">
                                    <InputLabel
                                        for="phone"
                                        value="Nomor Telepon"
                                    />
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
                                    <InputLabel
                                        for="instagram"
                                        value="Akun Instagram"
                                    />
                                    <TextInput
                                        id="instagram"
                                        v-model="form.instagram"
                                        type="text"
                                        class="block w-full"
                                        autocomplete="instagram"
                                        placeholder="@username"
                                        :error="form.errors.instagram"
                                    />
                                    <InputError
                                        :message="form.errors.instagram"
                                    />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="space-y-1">
                                    <InputLabel
                                        for="gudep"
                                        value="Pangkalan/Gudep"
                                    />
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
                                    <InputError
                                        :message="form.errors.kwarran"
                                    />
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
                                    <InputError
                                        :message="form.errors.number_id"
                                    />
                                </div>
                                <div class="space-y-1">
                                    <InputLabel
                                        for="level"
                                        value="Tingkatan Pramuka"
                                    />
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
                                    <InputError
                                        :message="form.errors.grade_id"
                                    />
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
                                        :image="data.card"
                                    />
                                    <InputError :message="form.errors.card" />
                                </div>
                                <div class="space-y-1">
                                    <InputLabel
                                        for="password"
                                        value="Kata Sandi"
                                    />
                                    <TextInput
                                        id="password"
                                        v-model="form.password"
                                        type="password"
                                        class="block w-full"
                                        autocomplete="password"
                                        placeholder="Kata Sandi"
                                        :error="form.errors.password"
                                    />
                                    <InputError
                                        :message="form.errors.password"
                                    />
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
                                        :error="
                                            form.errors.password_confirmation
                                        "
                                    />
                                    <InputError
                                        :message="
                                            form.errors.password_confirmation
                                        "
                                    />
                                </div>
                            </div>
                        </div>
                        <PrimaryButton>Simpan</PrimaryButton>
                    </form>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
