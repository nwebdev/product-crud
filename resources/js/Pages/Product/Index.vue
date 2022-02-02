<template>
    <Head title="Products" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded
                                "
                                :href="route('products.create')"
                            >
                                products Create
                            </Link>


                         <button v-on:click="deleteProduct" class="
                                  inline-flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                                ">Delete Selected</button>
                        </div>


                         <!-- <select v-model="select" style="margin-bottom:10px">
                            <option value="">Select</option>
                            <option value="">Delete All</option>
                        </select> -->


                        <table>
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td></td>
                                <td class="px-4 py-2">ID</td>
                                <td class="px-4 py-2">name</td>
                                <td class="px-4 py-2">price</td>
                                <td class="px-4 py-2">upc</td>
                                <td class="px-4 py-2">status</td>
                                <td class="px-4 py-2">image</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="product in products.data" :key="product.id">
                                   <td><input type="checkbox" v-model="deleteItems" :value="`${product.id}`"></td>
                                    <td class="px-4 py-2">{{ product.id }}</td>
                                    <td class="px-4 py-2">{{ product.name }}</td>
                                    <td class="px-4 py-2">{{ product.price }}</td>
                                    <td class="px-4 py-2">{{ product.upc }}</td>
                                    <td class="px-4 py-2">{{ product.status }}</td>
                                    <td class="px-4 py-2">
                                        <img
                                        data-original="{{ product.image }}"
                                        v-bind:src="product.image"
                                        height="50"
                                        width="50"
                                         alt="">
                                    </td>
                                        <!-- <img src="{{ product.image }}" height="10" width="10"></td> -->
                                    <!-- <td class="px-4 py-2">{{ product.image }}</td> -->
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link
                                            class="text-green-700"
                                            :href="route('products.edit', product.id)"
                                        >
                                            Edit
                                        </Link>
                                        <!-- <Link
                                            @click="destroy(post.id)"
                                            class="text-red-700"
                                            >Delete</Link
                                        > -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :links="products.links" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Link,
    },
    props: {
        products: Object,
    },
     data() {
            return {
              
              deleteItems: [],
              select: '',
              all_select: false
            }
        },
    methods: {

        destroy(id) {
            this.$inertia.delete(route("products.destroy", id));
        },

        deleteProduct() {
            // console.log(this.deleteItems)
                axios.post("/product-multi-delete/"+this.deleteItems)
                     .then((response) => {
                        this.deleteItems = [];
                        location.reload(); 
                     })
            },
    },
};
</script>