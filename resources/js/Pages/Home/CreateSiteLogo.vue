<script  setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';


const props = defineProps({

});
const form = useForm({

    image: '',

});
const submit = () => {
    router.post(route('logo.store'), form);
};
</script>


<template>
    <Head title="Posts" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home Setting
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
                    <InputLabel class="m-1 block w-full mb text-lg" for="image" value="Logo Upload" />
                    <input type="file" name="image" id="image" class="m-2 block"
                        @input="form.image = $event.target.files[0]">
                    <InputError class="m-2" :message="form.errors.image" />
                    <button class=" bg-blue-600 m-2 p-3 rounded-lg text-white" :type="submit"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </button>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template >

