<script setup>
    import { Head, Link, router } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue'
    import Swal from 'sweetalert2';
    const props = defineProps({
        products: {
            type: Object
        }
    });
</script>
<template>
    <Head  title="All Product" />
    
    <AuthenticatedLayout>
        <!-- header -->
        <template #header>
            Product List
        </template>
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
             <!-- Add Category -->
            <div class="flex justify-end">
                <button class="bg-blue-500 mx-1 mb-3 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded justify-content-end">
                    <Link :href="route('products.create')">
                        <i class="fa-solid fa-plus"></i>
                        Add Product
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
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/6">
                            Product Name
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/6">
                            Description
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/8">
                            Image
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/8">
                            Qty
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/8">
                            Old Price
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/8">
                            New Price
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/8">
                            InStock
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 w-1/8">
                            Status
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-gray-700" v-for="(product, i) in props.products" :key="product.id">

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ i+1 }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.title }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.description }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <img :src="product.image" :alt="product.title" class="w-1/2 h-1/2" >
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.quantity }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.old_price }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.new_price }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ product.inStock }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <a href="" class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded font-bold">
                                <i class="fa-solid fa-circle-check"></i>
                                Active
                            </a>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <button class="bg-blue-500 mx-1 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">
                                <Link :href="route('products.edit', product.id)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </Link>
                            </button>
                            <button  @click="deleteProduct(product, index)" class="bg-red-500 mx-1 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">
                                <i class="fa-solid fa-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- pagination -->
            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <!-- <pagination :links="products.links" /> -->
            </div>
        </div>
      </AuthenticatedLayout>
</template>
