<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({

    categories: Object,
});
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        router.delete(route('category.destroy', id));
    }
}
</script>

<style scoped></style>
<template>
    <Head title="Categories" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>
        <div class="flex flex-col md:flex mt-1">
            <Link
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold p-2 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                :href="route('category.create')">
            Create Category
            </Link>
            <table class="table-auto mt-4 border border-black">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-black">Id</th>
                        <th class="px-4 py-2 border border-black">Name</th>
                        <th class="px-4 py-2 border border-black">Detailes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories " :key="category.id">
                        <td class="border px-4 py-2 border-black">{{ category.id }}</td>
                        <td class="border px-4 py-2 border-black">{{ category.name }}</td>
                        <td class="border px-4 py-2 border-black">{{ category.detailes}}</td>
                        <td class="border px-4 py-2 border-black">
                            <Link class="btn bg-green-500 hover:bg-green-700 btn m-1 p-1"
                                :href="route('category.edit', category.id)">
                            Edit category
                            </Link>
                            <button class="bg-red-500 hover:bg-red-700 btn m-1 p-1" @click="destroy(category.id)">
                                Delete category
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>


    </AuthenticatedLayout>
</template>

