<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import ImageInput from "@/Components/ImageInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ActionButton from "@/Components/ActionButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
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
    grade: Object,
});

const form = useForm({
    name: "",
    image: null,
    description: "",
    curriculum: "",
    _method: "PUT",
});

const data = reactive({
    image: null,
});

onUpdated(() => {
    if (show) {
        data.image = props.grade?.full_path_image;
        form.name = props.grade?.name;
        form.description = props.grade?.description;
        form.curriculum = props.grade?.curriculum;
    }
});

const submit = () => {
    form.post(route("grade.update", props.grade?.id), {
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
                                <InputLabel for="name" value="Foto Krida" />
                                <ImageInput
                                    class="w-full h-60"
                                    @fileChange="fileChange"
                                    :image="data.image"
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
