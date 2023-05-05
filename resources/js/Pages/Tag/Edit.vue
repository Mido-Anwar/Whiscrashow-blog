<script  setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { router } from "@inertiajs/vue3";


const props = defineProps({
    tag: Object,
    categories:Array,
    tagCategory: String,
});
let form = useForm({
    name: props.tag.name,
    detailes: props.tag.detailes,
    tagCategory:props.tag.category.name
});

let submit = () => {
    router.post(`/tag/${props.tag.id}`, {
        _method: 'put',
        name: form.name,
        detailes: form.detailes,
        category_id:form.category_id,
    });
};



</script>
<template>
    <Head title="Edit Tags" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Tag
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('tag.index')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</Link>
                <hr>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                    <form @submit.prevent="submit" class="flex flex-col align-baseline justify-between" name="createForm">

                        <div class="m-2">
                            <InputLabel class="m-2" for="name" value="Name" />
                            <TextInput type="text" id="name" class=" m-1 block w-full" v-model="form.name" required
                                autofocus>
                            </TextInput>
                            <InputLabel class="m-2" for="detailes" value="detailes" />
                            <TextInput type="text" id="detailes" class=" block w-full m-1" v-model="form.detailes" required
                                autofocus>
                            </TextInput>
                            <InputLabel class="m-2 block w-full mb" for="categories">Categories</InputLabel>
                            <select id="categories" name="category_id" v-model="form.category_id" class=" m-1 block w-full ">
                                <option disabled value="">{{ tagCategory }}</option>
                                <option :value="category.id" v-for="category in categories" :key="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <div class="m-2">
                            <PrimaryButton type="submit" :disabled="form.processing">Save</PrimaryButton>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template >
