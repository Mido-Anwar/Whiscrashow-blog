<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

//
const props = defineProps({
    posts: Object,
    categories: Object,
});
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        router.delete(route('post.destroy', id));
    }
}
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>

        <template #header class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>
        <div class="flex flex-col md:flex mt-1">

            <Link
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold p-2 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                :href="route('post.create')">
            Create Post
            </Link>
            <table class="table-auto mt-4 border border-black">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-black">Id</th>
                        <th class="px-4 py-2 border border-black">Title</th>
                        <th class="px-4 py-2 border border-black">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts " :key="post.id">
                        <td class="border px-4 py-2 border-black">{{ post.id }}</td>
                        <td class="border px-4 py-2 border-black">{{ post.title }}</td>
                        <td class="border px-4 py-2 border-black">{{ post.post_category.name }}</td>
                        <td class="border px-4 py-2 border-black">
                            <Link class="btn bg-green-500 hover:bg-green-700 btn m-1 p-1"
                                :href="route('post.edit', post.id)">
                            Edit Post
                            </Link>
                            <button class="bg-red-500 hover:bg-red-700 btn m-1 p-1" @click="destroy(post.id)">
                                Delete Post
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </AuthenticatedLayout>
</template>
