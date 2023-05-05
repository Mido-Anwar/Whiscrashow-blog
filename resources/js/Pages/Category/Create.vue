<script  setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';



const form = useForm({
    name: '',
    detailes: '',

});

const submit = () => {
    router.post(route('category.store'), form);
};

</script>
<template>
    <Head title="Categories" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Category
            </h2>
        </template>

        <div class="flex flex-col align-baseline justify-between p-3 w-1/2 h-1/2">
            <div class="m-3">
                <Link :href="route('category.index')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-3 rounded">Back
                </Link>


                <form @submit.prevent="submit" class="flex flex-col align-baseline justify-between" name="createForm">

                    <div class="m-2">
                        <InputLabel class="m-1" for="name" value="Name" />
                        <TextInput type="text" id="name" class=" m-1 block w-full" v-model="form.name" required autofocus>
                        </TextInput>
                        <InputLabel class="m-1" for="detailes" value="Detailes" />
                        <TextInput type="text" id="detailes" class=" block w-full m-1" v-model="form.detailes" required
                            autofocus>
                        </TextInput>
                    </div>

                    <div class="m-2">
                        <SecondaryButton type="submit" :disabled="form.processing">Save</SecondaryButton>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template >
