<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>

                                            <!-- <td class="px-4 py-2">name</td>
                                <td class="px-4 py-2">price</td>
                                <td class="px-4 py-2">upc</td>
                                <td class="px-4 py-2">status</td>
                                <td class="px-4 py-2">image</td> -->


                                <!-- <label for="name">name</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                /> -->

                                <label for="name">name</label>
                                <input type="text" v-model="form.name" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 " />
                                <div v-if="errors.name" class="font-bold text-red-600" > {{ errors.name }} </div>


                                <label for="price">price</label>
                                <input type="text" v-model="form.price" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 " />
                                <div v-if="errors.price" class="font-bold text-red-600" > {{ errors.price }} </div>


                                <label for="upc">upc</label>
                                <input type="text" v-model="form.upc" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 " />
                                <div v-if="errors.upc" class="font-bold text-red-600" > {{ errors.upc }} </div>

                                <label for="status">status</label>
                               <select name="status" id="status" v-model="form.status" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 ">
                                    <option value="active" selected >active</option>
                                    <option value="inactive">in-active</option>
                                </select>
                               
                                <!-- <label for="image">image</label>
                                <input type="file" @change="previewFiles" multiple>
                                <input type="file" multiple v-model="form.image" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 " /> -->
                        
                        <label for="image">image Upload</label>

                                <input
                                    type="file"
                                    @change="previewImage"
                                    ref="photo"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />

                                 <img
                                    v-if="url"
                                    :src="url"
                                    class="w-full mt-4 h-80"
                                />
                                   <div
                                    v-if="errors.image"
                                    class="font-bold text-red-600"
                                >
                                    {{ errors.image }}
                                </div>
                            
                            </div>
                            <!-- <div class="mt-4">
                                <label for="price">price</label>
                                <textarea
                                    name="price"
                                    type="text"
                                    v-model="form.price"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                >
                                </textarea>
                            </div> -->

                            <!-- submit -->
                            <div class="flex items-center mt-4">
                                <button
                                    class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeLabel from "@/Components/Label";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
     props: {
        errors: Object,
    },
    setup() {
        const form = useForm({
            name: null,
            price: null,
            upc: null,
            status: 'active',
            image: null
        });

        return { form };
    },
    methods: {
        submit() {
              if (this.$refs.photo) {
                this.form.image = this.$refs.photo.files[0];
            }
            this.form.post(route("products.store"));
        },
         previewImage(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },
    },
};
</script>