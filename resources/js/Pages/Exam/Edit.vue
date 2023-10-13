<script setup>
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ActionButton from "@/Components/ActionButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onUpdated } from "vue";
import { PencilIcon } from "@heroicons/vue/24/outline";

const emit = defineEmits(["open"]);
const show = ref(false);
const props = defineProps({
    title: String,
    grades: Object,
    exam: Object,
});

const form = useForm({
    grade_id: "",
    title: "",
    time: "",
    information: "",
    passing_grade: "",
    multiple_choice: "",
    essay: "",
});

onUpdated(() => {
    if (show) {
        form.grade_id = props.exam?.grade_id;
        form.title = props.exam?.title;
        form.time = String(props.exam?.time);
        form.information = props.exam?.information;
        form.passing_grade = String(props.exam?.passing_grade);
        form.multiple_choice = String(props.exam?.multiple_choice);
        form.essay = String(props.exam?.essay);
    }
});

const submit = () => {
    form.put(route("exam.update", props.exam?.id), {
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
const grades = props.grades?.map((d) => ({ label: d.name, value: d.id }));
</script>
<template>
    <div>
        <ActionButton
            v-tooltip="lang().label.edit"
            @click.prevent="(show = true), emit('open')"
        >
            <PencilIcon class="w-4 h-auto" />
        </ActionButton>
        <DialogModal :show="show" @close="closeModal">
            <template #title>
                {{ lang().label.edit }} {{ props.title }}
            </template>

            <template #content>
                <form class="space-y-2" @submit.prevent="submit">
                    <div class="space-y-1">
                        <InputLabel for="title" value="Judul Penilaian" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            class="block w-full"
                            autocomplete="title"
                            placeholder="Judul Penilaian"
                            :error="form.errors.title"
                        />
                        <InputError :message="form.errors.title" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="grade_id" value="Krida" />
                        <SelectInput
                            id="grade_id"
                            :dataSet="grades"
                            v-model="form.grade_id"
                            class="block w-full"
                            :error="form.errors.grade_id"
                        />
                        <InputError :message="form.errors.grade_id" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="time"
                            value="Waktu Penilaian (Menit)"
                        />
                        <TextInput
                            id="time"
                            v-model="form.time"
                            type="number"
                            class="block w-full"
                            autocomplete="time"
                            placeholder="Waktu Penilaian (Menit)"
                            :error="form.errors.time"
                        />
                        <InputError :message="form.errors.time" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="information"
                            value="Informasi Penilaian"
                        />
                        <TextAreaInput
                            id="information"
                            v-model="form.information"
                            class="block w-full"
                            autocomplete="information"
                            placeholder="Informasi Penilaian"
                            :error="form.errors.information"
                        />
                        <InputError :message="form.errors.information" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="passing_grade" value="Passing Grade" />
                        <TextInput
                            id="passing_grade"
                            v-model="form.passing_grade"
                            type="number"
                            class="block w-full"
                            autocomplete="passing_grade"
                            placeholder="Passing Grade"
                            :error="form.errors.passing_grade"
                        />
                        <InputError :message="form.errors.passing_grade" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel
                            for="multiple_choice"
                            value="Bobot Pilihan Ganda (%)"
                        />
                        <TextInput
                            id="multiple_choice"
                            v-model="form.multiple_choice"
                            type="number"
                            class="block w-full"
                            autocomplete="multiple_choice"
                            placeholder="Bobot Pilihan Ganda (%)"
                            :error="form.errors.multiple_choice"
                        />
                        <InputError :message="form.errors.multiple_choice" />
                    </div>
                    <div class="space-y-1">
                        <InputLabel for="essay" value="Bobot Essay (%)" />
                        <TextInput
                            id="essay"
                            v-model="form.essay"
                            type="number"
                            class="block w-full"
                            autocomplete="essay"
                            placeholder="Bobot Essay (%)"
                            :error="form.errors.essay"
                        />
                        <InputError :message="form.errors.essay" />
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
