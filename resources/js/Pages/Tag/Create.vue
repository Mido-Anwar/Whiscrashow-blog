<script  setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';


defineProps({
    categories: Object,

});

const form = useForm({
    name: '',
    detailes: '',
    category_id: '',

});

const submit = () => {
    router.post(route('tag.store'), form);
};

</script>
<template>
    <Head title="Create Tags" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a Tag
            </h2>
        </template>
        <div class="flex flex-col align-baseline justify-between p-3 w-1/2 h-1/2">
            <div class="m-3">
                <Link :href="route('tag.index')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-3 rounded">Back
                </Link>


                <form @submit.prevent="submit" class="flex flex-col align-baseline justify-between" name="createForm">

                    <div class="m-2">
                        <InputLabel class="m-2" for="name" value="Name" />
                        <TextInput type="text" id="name" class=" m-1 block w-full" v-model="form.name" required autofocus>
                        </TextInput>
                        <InputLabel class="m-2" for="detailes" value="detailes" />
                        <TextInput type="text" id="detailes" class=" block w-full m-1" v-model="form.detailes" required
                            autofocus>
                        </TextInput>
                        <InputLabel class="m-2 block w-full mb" for="categories">Categories</InputLabel>
                        <select id="categories" name="category_id" v-model="form.category_id" class=" m-1 block w-full "
                            placeholder="Choose a Category">
                            <option disabled value="">Please select a Category</option>

                            <option :value="category.id" v-for="category in categories" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>

                    <div class="m-2">
                        <SecondaryButton type="submit" :disabled="form.processing">Save</SecondaryButton>
                    </div>

                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template >
