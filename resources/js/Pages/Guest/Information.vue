<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import CardMedia from "@/Components/Guest/CardMedia.vue";
import Pagination from "@/Components/Guest/Pagination.vue";
import { reactive } from "vue";

const props = defineProps({
    title: String,
    information: Object,
    filters: Object,
});

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
});
</script>
<template>
    <GuestLayout :title="props.title">
        <section class="min-h-[calc(100vh)]">
            <div
                data-aos="fade-up"
                data-aos-duration="1000"
                class="max-w-7xl mx-auto items-center px-4 sm:px-6 lg:px-8 pt-20 pb-8"
            >
                <div class="w-full block md:flex justify-between">
                    <div class="block">
                        <p class="text-2xl font-semibold uppercase">{{ props.title }}</p>
                    </div>
                </div>
                <div
                    class="my-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <CardMedia
                        v-for="(information, index) in information.data"
                        :key="index"
                        :href="
                            route('guest.information-detail', {
                                slug: information.slug,
                            })
                        "
                        :image="information.full_path_image"
                        :title="information.title"
                        :username="information?.user?.name"
                        :date="information?.date_view"
                    />
                </div>
                <div class="flex justify-between items-center">
                    <Pagination :links="information" :filters="data.filters" />
                </div>
            </div>
        </section>
    </GuestLayout>
</template>
