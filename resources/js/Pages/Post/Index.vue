<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

//
const props = defineProps({
    posts: Object,
    categories: Object,
    paginatePosts: Object,

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
        <div class="flex flex-col justify-center  md:flex mt-1">

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
                        <th class="px-4 py-2 border border-black">Tags</th>
                        <th class="px-4 py-2 border border-black">Actions</th>


                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in paginatePosts.data" :key="post.id">
                        <td class="border px-4 py-2 border-black">{{ post.id }}</td>
                        <td class="border px-4 py-2 border-black">{{ post.title }}</td>
                        <td class="border px-4 py-2 border-black">{{ post.category }}</td>
                        <!-- at this line i get post tags by two map function frist in backend and this line to name proprty because without that the return object will display key and value -->
                        <td class="border px-4 py-2 border-black">{{ post.postTags.map(({ name }) => name).toString() }} </td>

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
            <div class="flex justify-center my-4">
                <!--posts pagination -->
                <template v-for="link in paginatePosts.links">
                    <Link v-if="link.url" :href="link.url" v-html="link.label" class="ml-2 p-2 bg-neutral-300 rounded-md"
                        style="color: #0b0b0a; font-weight: bold; border: 2px solid black ;">
                    </Link>
                    <span v-else v-html="link.label" class="ml-2 p-2 bg-black rounded-md"
                        style="color: #ffffff; font-weight: bold; border: 2px solid rgb(255, 255, 255) ;"></span>
                </template>

            </div>

        </div>
    </AuthenticatedLayout>
</template>
