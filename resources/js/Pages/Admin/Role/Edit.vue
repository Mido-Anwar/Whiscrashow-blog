<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useRoles } from "@/composables/roles";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';


const props = defineProps({
    permissions: Array,
    role: Object,
    top:Object

});


const form = useForm({
    name: props.role.name,
    guard_name: props.role.guard_name,
    permission_id: ref([]),

});
const { hasPermission } = useRoles();
const submit = () => {
    router.post(`/role/${props.role.id}`, {
        _method: 'put',
        name: form.name,
        guard_name: form.guard_name,
        permission_id:form.permission_id,
    });
};
</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Edit Role {{ $page.props.auth.user.name }}
            </h2>
        </template>

        <div class="py-3 w-full">
            <Link
                class="bg-green-500 hover:bg-green-400 text-white font-bold p-2 border-b-4 border-green-700 hover:border-green-500 rounded"
                :href="route('user.index')">
            back
            </Link>
            <form @submit.prevent="submit" class="flex flex-col align-baseline justify-between w-full" name="createForm">

                <div class="m-2">
                    <InputLabel class="m-1" for="name" value="Name" />
                    <TextInput type="text" id="name" class=" m-1 block w-1/4" v-model="form.name" required autofocus>
                    </TextInput>
                    <InputLabel class="m-1" for="guard_name" value="guard" />
                    <TextInput type="text" id="guard_name" class=" block w-1/4 m-1" v-model="form.guard_name" required>
                    </TextInput>
                    <InputLabel for="permission" value="permissions" class="m-2" />
                    <span v-for="permission in permissions" v-bind:key="permission.id" id="permission"
                        class="flex items-center  m-4">
                        <input type="checkbox" :name="permission.name" v-model="form.permission_id" :id="permission.name"
                            :value="permission.id" class="m-2"  />
                        {{ permission.name }}
                        <InputError class="mt-2" :message="form.errors.permission_id" />
                    </span>
                </div>

                <div class="m-2">
                    <SecondaryButton type="submit" :disabled="form.processing">Save</SecondaryButton>
                </div>

            </form>
{{ top }}
        </div>

    </AuthenticatedLayout>
</template>

