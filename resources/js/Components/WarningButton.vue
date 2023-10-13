<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center px-4 py-2 bg-yellow-400 dark:bg-yellow-500 border border-yellow-300 dark:border-yellow-500 rounded font-semibold text-xs text-slate-600 dark:text-slate-600 uppercase tracking-widest shadow-sm hover:bg-yellow-300 dark:hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-yellow-500 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
