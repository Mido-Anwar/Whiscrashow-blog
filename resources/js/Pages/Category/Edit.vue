<script setup>
import { Head, Link,useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { reactive } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { router } from "@inertiajs/vue3";


const props = defineProps({
    category: Object,
});
let form = useForm({
    name: props.category.name,
    detailes:props.category.detailes,
});

let submit = () => {
    router.post(`/category/${props.category.id}`, {
        _method: 'put',
        name:form.name,
        detailes:form.detailes,
    });
};


</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('category.index')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</Link>
                <hr />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="" name="createForm">
                        <div class="m-5">
                            <InputLabel class="mt-1 block w-full mb">Title :</InputLabel>
                            <TextInput type="text" id="name" class="mt-1 block w-full" name="name" v-model="form.name"
                                required autofocus>
                            </TextInput>
                        </div>
                        <div class="m-5">
                            <InputLabel class="mt-1 block w-full mb">Title :</InputLabel>
                            <TextInput type="text" id="name" class="mt-1 block w-full" name="name" v-model="form.detailes"
                                required autofocus>
                            </TextInput>
                        </div>
                        <div class="m-5">
                            <PrimaryButton type="submit" class="ml-4" :disabled="form.processing">Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
