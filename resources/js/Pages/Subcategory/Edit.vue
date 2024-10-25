<script setup>
    import { Head, Link, useForm, router } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Swal from 'sweetalert2';
    const props = defineProps({
        subcategory:{
            type: Object
        }
    });

    const form = useForm({
        category_id: props.subcategory.category_id,
        subcategory_name: props.subcategory.subcategory_name,
        description: props.subcategory.description
    });

    /**
     * Update Category
     */
    // const updateCategory = async () =>{
    //     try {
    //         await router.put(route('categories.update', props.category.id), form, {

    //             onSuccess: page => {
    //                 Swal.fire({
    //                     toast: true,
    //                     position: "top-end",
    //                     icon: "success",
    //                     showConfirmButton: false,
    //                     timer: 3000,
    //                     timerProgressBar: true,
    //                     didOpen: (toast) => {
    //                         toast.onmouseenter = Swal.stopTimer;
    //                         toast.onmouseleave = Swal.resumeTimer;
    //                     },
    //                     title: page.props.flash.success
    //                 });
    //             }

    //         });
    //     } catch (error) {
    //         console.log(error);
    //     }
    // }   

</script>
<template>
    <Head  title="Edit SubCategory" />
    {{ $page.props.subcategory }}
    <AuthenticatedLayout>
          <!-- header -->
        <template #header>
            Edit SubCategory
        </template>
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-10 bg-white rounded">
            <form>
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <!-- select category name -->
                    <div class="sm:col-span-2">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" v-model="form.category_id">
                            <option selected=""></option>
                        </select>
                    </div>

                    <!-- subcategory name -->
                    <div class="sm:col-span-2">
                        <label for="subcategory_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SubCategory
                            Name</label>
                        <input type="text" name="subcategory_name" id="subcategory_name" v-model="form.subcategory_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Category name" required="">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" rows="4" v-model="form.description" name="description"  
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Category description"></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-blue-500 text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Save
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

