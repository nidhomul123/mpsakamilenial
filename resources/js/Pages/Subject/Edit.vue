<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import ImageInput from "@/Components/ImageInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ActionButton from "@/Components/ActionButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onUpdated, reactive } from "vue";
import { PencilIcon } from "@heroicons/vue/24/outline";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: String,
    grades: Object,
    subject: Object,
});

const form = useForm({
    grade_id: "",
    title: "",
    image: null,
    description: "",
    subject: "",
    _method: "PUT",
});

const data = reactive({
    image: null,
});

onUpdated(() => {
    if (show) {
        data.image = props.subject?.full_path_image;
        form.grade_id = props.subject?.grade_id;
        form.title = props.subject?.title;
        form.description = props.subject?.description;
        form.subject = props.subject?.subject;
    }
});

const submit = () => {
    form.post(route("subject.update", props.subject?.id), {
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
const grades = props.grades?.map((grade) => ({
    label: grade.name,
    value: grade.id,
}));
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
                        <div class="space-y-2">
                            <div class="space-y-1">
                                <InputLabel for="name" value="Foto Materi" />
                                <ImageInput
                                    class="w-full h-60"
                                    @fileChange="fileChange"
                                    :image="data.image"
                                />
                                <InputError :message="form.errors.image" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="title" value="Judul Materi" />
                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="title"
                                    placeholder="Judul Materi"
                                    :error="form.errors.title"
                                />
                                <InputError :message="form.errors.title" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="grade_id" value="Krida" />
                                <SelectInput
                                    id="grade_id"
                                    v-model="form.grade_id"
                                    :dataSet="grades"
                                    class="block w-full"
                                    :error="form.errors.grade_id"
                                />
                                <InputError :message="form.errors.grade_id" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel
                                    for="description"
                                    value="Deskripsi Materi"
                                />
                                <TextAreaInput
                                    id="description"
                                    v-model="form.description"
                                    class="block w-full"
                                    rows="4"
                                    autocomplete="description"
                                    placeholder="Deskripsi Materi"
                                    :error="form.errors.description"
                                />
                                <InputError
                                    :message="form.errors.description"
                                />
                            </div>
                        </div>
                        <div class="space-y-2 sm:col-span-2">
                            <div class="space-y-1">
                                <InputLabel for="subject" value="Materi" />
                                <QuillEditor
                                    id="subject"
                                    :style="'border: none'"
                                    v-model:content="form.subject"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.subject" />
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
