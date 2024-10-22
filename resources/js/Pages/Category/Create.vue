<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Swal from 'sweetalert2';
</script>
<template>
    <Head  title="Add Category" />

    <AuthenticatedLayout>
          <!-- header -->
        <template #header>
            Add Category
        </template>
    </AuthenticatedLayout>
</template>


