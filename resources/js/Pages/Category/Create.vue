<script setup>
    import { Head, Link, useForm, router } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Swal from 'sweetalert2';

    const form = useForm({
        category_name: null,
        description: null
    });

    /**
     * Store Category
     */

     const storeCategory = async () =>{
        try {
            await router.post(route('categories.store'), form, {
                onSuccess: page => {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                        title: page.props.flash.success
                    });
                }
            });
        } catch (error) {
            console.log(error);
        }
     }

</script>
<template>

    <Head title="Add Category" />

    <AuthenticatedLayout>
        <!-- header -->
        <template #header>
            Add Category
        </template>

        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-10 bg-white rounded">
            <form @submit.prevent="storeCategory()">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <!-- category name -->
                    <div class="sm:col-span-2">
                        <label for="category_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                            Name</label>
                        <input type="text" name="category_name" id="category_name" v-model="form.category_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Category name" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="4" name="description" v-model="form.description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Category description "></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-blue-500 text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add Category
                </button>
            </form>
        </div>

    </AuthenticatedLayout>
</template>
