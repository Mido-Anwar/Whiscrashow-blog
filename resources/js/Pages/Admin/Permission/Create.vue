<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useRoles } from "@/composables/roles";
import TextInput from '@/Components/TextInput.vue';






const form = useForm({
    name: '',
    guard_name: '',

});

const submit = () => {
    router.post(route('permission.store'), form);
};
</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a New Permission {{ $page.props.auth.user.name }}
            </h2>
        </template>
        <div class="py-3">
            <Link
                class="bg-green-500 hover:bg-green-400 text-white font-bold p-2 border-b-4 border-green-700 hover:border-green-500 rounded"
                :href="route('user.index')">
back
            </Link>
            <form @submit.prevent="submit" class="flex flex-col align-baseline justify-between" name="createForm">

                <div class="m-2">
                    <InputLabel class="m-1" for="name" value="Name" />
                    <TextInput type="text" id="name" class=" m-1 block w-full" v-model="form.name" required autofocus>
                    </TextInput>
                    <InputLabel class="m-1" for="guard_name" value="guard" />
                    <TextInput type="text" id="guard_name" class=" block w-full m-1" v-model="form.guard_name" required>
                    </TextInput>
                </div>

                <div class="m-2">
                    <SecondaryButton type="submit" :disabled="form.processing">Save</SecondaryButton>
                </div>

            </form>

        </div>

    </AuthenticatedLayout>
</template>

