<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import ImageInput from "@/Components/ImageInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ActionButton from "@/Components/ActionButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onUpdated, reactive } from "vue";
import { PencilIcon } from "@heroicons/vue/24/outline";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: String,
    roles: Object,
    information: Object,
});

const form = useForm({
    title: "",
    image: null,
    text: "",
    published: 1,
    date: "",
    _method: "PUT",
});

const data = reactive({
    image: null,
});

onUpdated(() => {
    if (show) {
        data.image = props.information?.full_path_image;
        form.title = props.information?.title;
        form.text = props.information?.text;
        form.date = props.information?.date;
        form.published = props.information?.published;
    }
});

const submit = () => {
    form.post(route("information.update", props.information?.id), {
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
const publishes = [
    { label: "Ya", value: 1 },
    { label: "Tidak", value: 0 },
];
</script>
<template>
    <div>
        <ActionButton
            v-tooltip="lang().label.edit"
            @click.prevent="(show = true), emit('open')"
        >
            <PencilIcon class="w-4 h-auto" />
        </ActionButton>
        <DialogModal :show="show" @close="closeModal" maxWidth="6xl">
            <template #title>
                {{ lang().label.edit }} {{ props.title }}
            </template>

            <template #content>
                <form class="space-y-2" @submit.prevent="submit">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div class="space-y-2 sm:col-span-2">
                            <div class="space-y-1">
                                <InputLabel
                                    for="title"
                                    value="Judul Informasi"
                                />
                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="title"
                                    placeholder="Judul Informasi"
                                    :error="form.errors.title"
                                />
                                <InputError :message="form.errors.title" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="text" value="Informasi" />
                                <QuillEditor
                                    id="text"
                                    :style="'border: none'"
                                    v-model:content="form.text"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.text" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="space-y-1">
                                <InputLabel for="image" value="Foto" />
                                <ImageInput
                                    class="w-full h-60"
                                    @fileChange="fileChange"
                                    :image="data.image"
                                />
                                <InputError :message="form.errors.image" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="date" value="Tanggal" />
                                <TextInput
                                    id="date"
                                    v-model="form.date"
                                    type="date"
                                    class="block w-full"
                                    autocomplete="date"
                                    placeholder="Tanggal"
                                    :error="form.errors.date"
                                />
                                <InputError :message="form.errors.date" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="published" value="Publish" />
                                <SelectInput
                                    id="published"
                                    v-model="form.published"
                                    :dataSet="publishes"
                                    class="block w-full"
                                    :error="form.errors.published"
                                />
                                <InputError :message="form.errors.published" />
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
    @apply h-[430px] border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-primary focus:border-2 dark:focus:border-primary focus:ring-primary dark:focus:ring-primary rounded shadow-sm placeholder:text-slate-300 dark:placeholder:text-slate-700;
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
