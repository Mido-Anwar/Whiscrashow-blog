<script  setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { router } from '@inertiajs/vue3';



const props =defineProps({

});
const form = useForm({
    image: '',
});
const submit = () => {
    router.post(route(`home.store`), form);
};
</script>


<template>
    <Head title="Home Setting" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home Setting
            </h2>
        </template>

        <div class="flex flex-col justify-between ">
            <h2 class="m-2 text-gray-700 text-lg font-semibold">HELLO {{ $page.props.auth.user.name }}</h2>
            <Link :href="route('dashboard')" class="
            m-5
            bg-blue-500
            hover:bg-blue-400
            text-white
            font-bold
            p-2 border-b-4
            border-blue-700
                     rounded my-4 w-1/4
                     ">
                Back
                </Link>
            <div class="flex flex-col justify-between w-11/12">

                <form @submit.prevent="submit">
                    <InputLabel class="my-5 block mb text-lg" for="image" value="Logo Upload" />
                    <input type="file" name="image" id="image" class="m-2 block"
                        @input="form.image = $event.target.files[0]" />
                    <InputError class="m-2" :message="form.errors.image" />
                    <div class="my-10">
                        <button class="m-2
                     bg-green-900
                     hover:bg-green-400
                     text-white font-bold
                     hover:text-red-800
                         p-2 border-b-4
                          border-green-700
                           rounded
                           my-4
                            w-1/4" :type="submit" :class="{ 'opacity-25': form.processing }">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template >

