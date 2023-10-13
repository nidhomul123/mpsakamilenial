<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { PlusIcon } from "@heroicons/vue/24/outline";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const show = ref(false);
const props = defineProps({
    title: String,
});

const form = useForm({
    exam_id: route().params.exam_id,
    type: route().params.type,
    question: "",
    a: null,
    b: null,
    c: null,
    d: null,
    e: null,
    key: "a",
});

const submit = () => {
    form.post(route("question.store"), {
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
const keys = [
    { label: "A", value: "a" },
    { label: "B", value: "b" },
    { label: "C", value: "c" },
    { label: "D", value: "d" },
    { label: "E", value: "e" },
];
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
        <DialogModal :show="show" @close="closeModal" maxWidth="3xl">
            <template #title>
                {{ lang().label.add }} {{ props.title }}
            </template>

            <template #content>
                <form class="space-y-2" @submit.prevent="submit">
                    <div class="space-y-1">
                        <InputLabel for="question" value="Soal" />
                        <QuillEditor
                            id="question"
                            :style="'border: none'"
                            v-model:content="form.question"
                            theme="snow"
                            toolbar="full"
                            content-type="html"
                            :class="'rounded'"
                        />
                        <InputError :message="form.errors.question" />
                        <div v-show="route().params.type == 'Multiple Choice'">
                            <div class="space-y-1">
                                <InputLabel for="a" value="Jawaban A" />
                                <QuillEditor
                                    id="a"
                                    :style="'border: none'"
                                    v-model:content="form.a"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.a" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="b" value="Jawaban B" />
                                <QuillEditor
                                    id="b"
                                    :style="'border: none'"
                                    v-model:content="form.b"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.b" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="c" value="Jawaban C" />
                                <QuillEditor
                                    id="c"
                                    :style="'border: none'"
                                    v-model:content="form.c"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.c" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="d" value="Jawaban D" />
                                <QuillEditor
                                    id="d"
                                    :style="'border: none'"
                                    v-model:content="form.d"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.d" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="e" value="Jawaban E" />
                                <QuillEditor
                                    id="e"
                                    :style="'border: none'"
                                    v-model:content="form.e"
                                    theme="snow"
                                    toolbar="full"
                                    content-type="html"
                                    :class="'rounded'"
                                />
                                <InputError :message="form.errors.e" />
                            </div>
                            <div class="space-y-1">
                                <InputLabel for="key" value="Kunci Jawaban" />
                                <SelectInput
                                    id="key"
                                    v-model="form.key"
                                    :dataSet="keys"
                                    class="block w-full"
                                    :error="form.errors.key"
                                />
                                <InputError :message="form.errors.key" />
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
    @apply h-[100px] border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-primary focus:border-2 dark:focus:border-primary focus:ring-primary dark:focus:ring-primary rounded shadow-sm placeholder:text-slate-300 dark:placeholder:text-slate-700;
}
.ql-toolbar.ql-snow {
    @apply rounded border-slate-300 dark:text-slate-100 dark:border-slate-700 dark:bg-slate-900;
}
.ql-tooltip {
    left: 0 !important;
}
</style>
