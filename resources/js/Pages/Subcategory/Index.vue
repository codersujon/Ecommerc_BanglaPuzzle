<script setup>
    import { Head, Link, router } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue'
    import Swal from 'sweetalert2';

    // Props
    const props = defineProps({
        subcategories: {
            type: Object
        }
    });

    /**
     * Delete SubCategory
     */
    const deleteSubcategory = (subcategory, i) =>{
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#009432",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No",
        }).then((result)=>{
                if(result.isConfirmed){

                    try {
                    router.delete('subcategories/' + subcategory.id, {
                        onSuccess: (page) => {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                icon: "success",
                                showConfirmButton: false,
                                title: page.props.flash.success
                            });
                        }
                    });

                    } catch (error) {
                        console.log(error);
                    }
                }
        });
    }

</script>
<template>
      <Head  title="Subcategory" />
      
      <AuthenticatedLayout>
        <!-- header -->
        <template #header>
            Subcategory List
        </template>

        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <!-- Add Category -->
            <div class="flex justify-end">
                <button class="bg-blue-500 mx-1 mb-3 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded justify-content-end">
                    <Link :href="route('subcategories.create')">
                        <i class="fa-solid fa-plus"></i>
                        Add Subcategory
                    </Link>
                </button>
            </div>
    
            <!-- table -->
           <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-slate-950 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            #Id
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Category Name
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            SubCategory Name
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/4">
                            Description
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Status
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-gray-700" v-for="(subcategory, i) in  props.subcategories.data" :key="subcategory.id">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ i+1 }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ subcategory.category.category_name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ subcategory.subcategory_name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ subcategory.description }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <a href="" class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded font-bold">
                                <i class="fa-solid fa-circle-check"></i>
                                Active
                            </a>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <button class="bg-blue-500 mx-1 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">
                                <Link :href="route('subcategories.edit', subcategory.id)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </Link>
                            </button>
                            <button @click="deleteSubcategory(subcategory, i)" class="bg-red-500 mx-1 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- pagination -->
            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="subcategories.links" />
            </div>
        </div>
      </AuthenticatedLayout>
</template>


