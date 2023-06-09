<script  setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import Editor from '@tinymce/tinymce-vue';


const props = defineProps({
    categories: Array,
    tags: Array,
    Auth: Number,
});
const form = useForm({
    title: '',
    content: '',
    image: '',
    slug: '',
    tag_id: ref([]),
    user_id: props.Auth,
    category_id: '',
});
const submit = () => {
    router.post(route('post.store'), form);
};

</script>


<template>
    <Head title="Posts" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Posts
            </h2>
        </template>

        <div class="flex flex-col justify-between w-1/2 h-1/2">
            <h2 class="m-2 text-gray-700 text-lg font-semibold">HELLO __ {{ $page.props.auth.user.name }}</h2>
            <div class="flex flex-col justify-between">
                <Link :href="route('post.index')"
                    class="m-2 bg-blue-500 hover:bg-blue-400 text-white font-bold p-2 border-b-4 border-blue-700 rounded w-1/6">
                Back
                </Link>
                <form @submit.prevent="submit">
                    <InputLabel for="title" value="Title" />
                    <TextInput type="text" v-model="form.title" class="m-2 w-1/2" dir="rtl"></TextInput>
                    <InputError class="mt-2" :message="form.errors.title" />

                    <InputLabel for="content" value="Content" />
                    <div>
                        <Editor v-model="form.content" api-key="az1dyax66x07uneuuxzi6xos9oh0r277imflde417td7p4z5" />
                    </div>
                    <InputError class="m-2" :message="form.errors.content" />

                    <InputLabel class="m-1 block w-full mb" for="image" value="Image" />
                    <input type="file" name="image" id="image" class="m-2 block"
                        @input="form.image = $event.target.files[0]">
                    <InputError class="m-2" :message="form.errors.image" />

                    <InputLabel class="m-2 block w-full mb" for="categories" value="Categories" />
                    <select id="categories" name="category_id" v-model="form.category_id" class="m-2">
                        <option disabled value="">Please select a Category</option>
                        <option :value="category.id" v-for="category in categories" v-bind:key="category.id">{{
                            category.name
                        }}
                        </option>
                    </select>
                    <InputError class="m-1" :message="form.errors.category_id" />
                    <InputLabel for="tag" value="Tags" class="m-2" />
                    <span v-for="tag in tags" v-bind:key="tag.id" id="tag" class="flex items-center m-4">
                        <input type="checkbox" :name="tag.name" v-model="form.tag_id" :id="tag.name" :value="tag.id"
                            class="m-2" />
                        {{ tag.name }}
                        <InputError class="mt-2" :message="form.errors.tag_id" />
                    </span>

                    <button class=" bg-blue-600 m-2 p-3 rounded-lg text-white" :type="submit"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </button>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template >
