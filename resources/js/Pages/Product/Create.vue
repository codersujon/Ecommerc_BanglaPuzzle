<script setup>
    import { Head, Link, router, useForm } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue'
    import Swal from 'sweetalert2';

    // Props
    const props = defineProps({
        categories:{
            type: Object
        }
    });


    const form = useForm({
        product_name: null,
        selectedCategory: null,
        selectedSubcategory: null,
        product_image: null,
        quantity: null,
        inStock: null,
        old_price: null,
        new_price: null,
        product_description: null,

        subcategories: [],
    });


    // Category Chagne to Update SubCategories
    const updateSubcategories = () =>{
        const selected = props.categories.find(cat => cat.id === form.selectedCategory);
        // console.log(selected.subcategories);
        form.subcategories = selected ? selected.subcategories : [];
        form.selectedSubcategory = '';
    }

    // Product Store
    const storeProduct = async () =>{
        try {
            await router.post(route('products.store'), form, {
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
            })
        }catch(error){
            console.log(error);
        }
    }

</script>
<template>
    <Head  title="Add Product" />

    <AuthenticatedLayout>
        <!-- header -->
        <template #header>
            Add Product
        </template>
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-10 bg-white rounded">
            <form @submit.prevent="storeProduct()" multipart="">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <!-- product name -->
                    <div class="sm:col-span-2">
                        <label for="product_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                            Name</label>
                        <input type="text" name="product_name" id="product_name" v-model="form.product_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Product name">
                    </div>

                    <!-- Category name -->
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
                        <select id="category_id" v-model="form.selectedCategory"  @change="updateSubcategories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a category</option>
                            <option :value="category.id" v-for="category in props.categories" :key="category.id">{{ category.category_name }}</option>
                        </select>
                    </div>

                    <!-- Select Subcategory name -->
                    <div>
                        <label for="subcategory_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Subcategory</label>
                        <select id="subcategory_id" v-model="form.selectedSubcategory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a Subcategory</option>
                            <option :value="subcategory.id" v-for="subcategory in form.subcategories" :key="subcategory.id">{{ subcategory.subcategory_name }}</option>
                        </select>
                    </div>


                    <!-- Image Upload -->
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="product_image">Product Image</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="product_image" type="file" @input="form.product_image = $event.target.files[0]">
                    </div>

                    <!-- quantity -->
                    <div>
                        <label for="quantity"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="number" name="quantity" id="quantity" v-model="form.quantity"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Quantity" required="">
                    </div>

                     <!-- InStock -->
                     <div>
                        <label for="inStock"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">In Stock</label>
                        <input type="number" name="inStock" id="inStock" v-model="form.inStock"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="inStock" required="">
                    </div>

                     <!-- old price -->
                     <div>
                        <label for="old_price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old Price</label>
                        <input type="number" name="old_price" v-model="form.old_price" id="old_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Old Price" required="">
                    </div>

                    <!-- new price -->
                    <div>
                        <label for="new_price"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Price</label>
                        <input type="number" name="new_price" id="new_price" v-model="form.new_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="New Price" required="">
                    </div>


                    <!-- product description -->
                    <div class="sm:col-span-2">
                        <label for="product_description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                        <textarea id="product_description" rows="2" v-model="form.product_description" name="product_description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Product description">
                        </textarea>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center bg-blue-500 text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add Product
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
