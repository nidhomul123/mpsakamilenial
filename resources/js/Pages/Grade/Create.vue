<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import ImageInput from "@/Components/ImageInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import { useForm } from "@inertiajs/vue3";
import { PlusIcon } from "@heroicons/vue/24/outline";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { ref } from "vue";

const show = ref(false);
const props = defineProps({
    title: String,
});

const form = useForm({
    name: "",
    image: null,
    description: "",
    curriculum: "",
});

const submit = () => {
    form.post(route("grade.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => null,
        onFinish: () => null,
    });
};

const closeModal = () => {
    show.value = false;
    form.errors = {};
    form.reset();
};
const fileChange = (value) => {
    form.image = value.file;
};
</script>
<template>
    <div>
        <PrimaryButton
            class="flex rounded-none items-center justify-start gap-2"
            @click.prevent="show = true"
        >
            <PlusIcon class="w-4 h-auto" />
            <span class="hidden md:block">{{ lang().button.add }}</span>
        </PrimaryButton>
        <DialogModal :show="show" @close="closeModal" maxWidth="6xl">
            <template #title>
                {{ lang().label.add }} {{ props.title }}
            </template>

            <template #content>
                <form class="space-y-2" @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div class="space-y-2">
                            <div class="space-y-1">
                                <InputLabel for="name" value="Foto Krida" />
                                <ImageInput
                                    class="w-full h-60"
                                    @fileChange="fileChange"
                                />
                                <InputError :message="form.errors.image" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="name" value="Nama Krida" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="name"
                                    placeholder="Nama Krida"
                                    :error="form.errors.name"
                                />
                                <InputError :message="form.errors.name" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel
                                    for="description"
                                    value="Deskripsi Krida"
                                />
                                <TextAreaInput
                                    id="description"
                                    v-model="form.description"
                                    class="block w-full"
                                    rows="4"
                                    autocomplete="description"
                                    placeholder="Deskripsi Krida"
                                    :error="form.errors.description"
                                />
                                <InputError
                                    :message="form.errors.description"
                                />
                            </div>
                        </div>
                        <div class="space-y-2 sm:col-span-2">
                            <div class="space-y-1">
                                <InputLabel
                                    for="curriculum"
                                    value="Kurikulum"
                                />
                                <QuillEditor
                                    id="curriculum"
                                    :style="'border: none'"
                                    v-model:content="form.curriculum"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.curriculum" />
                            </div>
                        </div>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal">
                    {{ lang().button.cancel }}
                </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="submit"
                >
                    {{ lang().button.save }} {{ form.processing ? "..." : "" }}
                </PrimaryButton>
            </template>
        </DialogModal>
    </div>
</template>

<style>
.ql-editor {
    @apply h-96 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-primary focus:border-2 dark:focus:border-primary focus:ring-primary dark:focus:ring-primary rounded shadow-sm placeholder:text-slate-300 dark:placeholder:text-slate-700;
}
.ql-toolbar.ql-snow {
    @apply rounded border-slate-300 dark:text-slate-100 dark:border-slate-700 dark:bg-slate-900;
}
.ql-tooltip {
    left: 0 !important;
}
</style>
