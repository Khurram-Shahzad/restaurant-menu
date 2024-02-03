<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

defineProps(['menus', 'items'])
let form = useForm({
    menu_id: '',
    'item_id': ''
});

let submit = () => {
    form.post(route('menu.store-item'));
}
</script>

<template>
    <AppLayout title="Menu">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Add Item to Menu
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label class="block" for="name">Select Menu</label>
                                <select v-model="form.menu_id">
                                    <option value="">-- Select Menu -- </option>
                                    <option v-for="menu in menus" :value="menu.id" :key="menu.id" v-text="menu.name"></option>
                                </select>
                            </div>

                            <div>
                                <label class="block" for="name">Select Item</label>
                                <select v-model="form.item_id">
                                    <option value="">-- Select Item -- </option>
                                    <option v-for="item in items" :value="item.id" :key="item.id" v-text="item.name"></option>
                                </select>
                            </div>

                            <div>
                                <input type="submit" value="Add Item To Menu">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
