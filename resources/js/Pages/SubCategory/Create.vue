<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps(['categories'])
let form = useForm({
    category_id: '',
    parent_subcategory_id: '',
    name: ''
});
const displaySubCategories = ref(false);
let subCategories = ref([]);

let getSubCategories = () => {
    displaySubCategories.value = false;
    if (! form.category_id) {
        return;
    }

    // for (const [key, value] of Object.entries(props.categories)) {
    //     if (form.category_id !== value.id) {
    //         continue;
    //     }
    //     if (! value.sub_categories.length) {
    //         break;
    //     }
    //     subCategories.value = value.sub_categories;
    //     displaySubCategories.value = true;
    // }


    axios.get(`/api/subcategories/${form.category_id}`)
        .then(response => {
            if (response.data.length) {
                subCategories.value = response.data;
                displaySubCategories.value = true;
            }
        });
}

let submit = () => {
    form.post(route('subcategory.store'));
}
</script>

<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create SubCategory
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label class="block" for="category">Select Category</label>
                                <select @change="getSubCategories" v-model="form.category_id" required>
                                    <option value="">Select Category</option>
                                    <option v-for="category in categories" :value="category.id" :key="category.id" v-text="category.name"></option>
                                </select>
                            </div>
                            <div v-if="displaySubCategories">
                                <label class="block" for="subcategory">Select SubCategory</label>
                                <select v-model="form.parent_subcategory_id">
                                    <option value="">Select SubCategory</option>
                                    <option v-for="subcategory in subCategories" :value="subcategory.id" :key="subcategory.id" v-text="subcategory.name"></option>
                                </select>
                            </div>
                            <div>
                                <label class="block" for="name">SubCategory Name</label>
                                <input type="text" v-model="form.name" required>
                            </div>

                            <div>
                                <input type="submit" value="Create SubCategory">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
