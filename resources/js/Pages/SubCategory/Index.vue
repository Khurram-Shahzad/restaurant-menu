<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import {onMounted} from "vue";
const props = defineProps(['subCategories'])
</script>

<template>
    <AppLayout title="Category">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                SubCategory
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div class="text-right">
                            <Link :href="route('subcategory.create')">Create New Sub Category</Link>
                        </div>
                        <ul>
                            <li v-for="subCategory in subCategories">
                                <strong v-if="subCategory.category"> {{ subCategory.category.name }} -> </strong>
                                    {{ subCategory.name }}
                                <ul v-if="subCategory.children">
                                    <li v-for="children in subCategory.children" v-text="children.name"></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
