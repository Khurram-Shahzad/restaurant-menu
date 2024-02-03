<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
import {onMounted} from "vue";
const props = defineProps(['menus', 'menuWithDiscounts'])
</script>

<template>
    <AppLayout title="Category">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Menu
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <div class="text-right">
                            <Link :href="route('menu.create')">Create New Menu</Link>
                            <div>
                                <Link v-if="menus.length" :href="route('menu.add-item')">Add Item to Menu</Link>
                            </div>

                        </div>
                        <ul>

                            <li v-for="menu in menus" v-text="menu.name" :key="menu.id"></li>
                        </ul>
                        <ul v-if="menuWithDiscounts">
                            <li v-for="(value, index) in menuWithDiscounts">
                            {{ index }}
                            <ul v-for="menu in value">
                                {{ menu.name  }} - Discount ( {{ menu.discount }} )
                            </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
