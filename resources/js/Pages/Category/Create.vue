<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link, useForm} from "@inertiajs/vue3";
let form = useForm({
    name: '',
    discount: ''
});

let submit = () => {
    form.post(route('category.store'));
}
</script>

<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label class="block" for="category">Enter Category Name</label>
                                <input type="text" v-model="form.name" required>
                            </div>
                            <div>
                                <label class="block" for="discount">Discount</label>
                                <input type="number"  v-model="form.discount">
                            </div>
                            <div>
                                <input type="submit" value="Create Category">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
