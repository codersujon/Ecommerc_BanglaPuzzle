<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <Head  title="Edit Category" />

    <AuthenticatedLayout>
          <!-- header -->
        <template #header>
            Edit Category
        </template>
    </AuthenticatedLayout>
</template>

