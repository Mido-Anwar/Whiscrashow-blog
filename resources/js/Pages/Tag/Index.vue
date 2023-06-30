
<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';


defineProps({
    tags: Object,
    tags2:Object
});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        router.delete(route('tag.destroy', id));
    }
}
</script>

<template>
    <Head title="Tags" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tags
            </h2>
        </template>
        <div class="flex flex-col md:flex mt-1">
            <Link
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold p-2 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                :href="route('tag.create')">
            Create Tag
            </Link>
            <table class="table-auto mt-4 border border-black">
                <thead class="px-4 py-2 border-black">
                    <tr>
                        <th class="px-4 py-2 border border-black">Id</th>
                        <th class="px-4 py-2 border border-black">Name</th>
                        <th class="px-4 py-2 border border-black">Detailes</th>
                        <th class="px-4 py-2 border border-black">Category</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in tags " :key="tag.id">
                        <td class="border px-4 py-2 border-black">{{ tag.id }}</td>
                        <td class="border px-4 py-2 border-black">{{ tag.name }}</td>
                        <td class="border px-4 py-2 border-black">{{ tag.detailes }}</td>
                        <td class="border px-4 py-2 border-black">{{ tag.category.name }}</td>
                        <td class="border px-4 py-2 border-black">
                            <Link class="btn bg-green-500 hover:bg-green-700 btn m-1 p-1" :href="route('tag.edit', tag.id)">
                            Edit tag
                            </Link>
                            <button class="bg-red-500 hover:bg-red-700 btn m-1 p-1" @click="destroy(tag.id)">
                                Delete tag
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
            {{ tags2 }}
        </div>

    </AuthenticatedLayout>
</template>
