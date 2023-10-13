<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ActionButton from "@/Components/ActionButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onUpdated } from "vue";
import { PencilIcon } from "@heroicons/vue/24/outline";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: String,
    roles: Object,
    question: Object,
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

onUpdated(() => {
    if (show) {
        form.exam_id = props.question?.exam_id;
        form.type = props.question?.type;
        form.question = props.question?.question;
        form.a = props.question?.a;
        form.b = props.question?.b;
        form.c = props.question?.c;
        form.d = props.question?.d;
        form.e = props.question?.e;
        form.key = props.question?.key;
    }
});

const submit = () => {
    form.put(route("question.update", props.question?.id), {
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
        <ActionButton
            v-tooltip="lang().label.edit"
            @click.prevent="(show = true), emit('open')"
        >
            <PencilIcon class="w-4 h-auto" />
        </ActionButton>
        <DialogModal :show="show" @close="closeModal" maxWidth="3xl">
            <template #title>
                {{ lang().label.edit }} {{ props.title }}
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
