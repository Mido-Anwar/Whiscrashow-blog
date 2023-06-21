<script setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useRoles } from "@/composables/roles";

defineProps({
    users: Object,
    permissions: Object,
    roles: Object,
    userspage: Object
});

const { roleDestroy } = useRoles();
const { permissionDestroy } = useRoles();
const { userDestroy } = useRoles();
</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin
            </h2>
        </template>
        <div class="flex flex-col w-full px-2 mt-2">
            <Link
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold p-2 border-b-4 border-blue-700 hover:border-blue-500 rounded w-1/4"
                :href="route('user.create')">
            Create New User
            </Link>



            <table class="table-auto mt-4 border border-black">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-black">Id</th>
                        <th class="px-4 py-2 border border-black">Name</th>
                        <th class="px-4 py-2 border border-black">Email</th>
                        <th class="px-4 py-2 border border-black">Role</th>
                        <th class="px-4 py-2 border border-black">
                            permissions
                        </th>
                        <th class="px-4 py-2 border border-black">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                        <td class="px-4 py-2 border border-black">
                            {{ user.id }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ user.name }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ user.email }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ user.role.toString() }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ user.permission.toString()  }}
                        </td>
                        <td>
                            <Link class="bg-gray-500 hover:bg-gray-700 btn m-1" :href="route('user.edit', user.id)">
                            Edit user
                            </Link>
                            <button class="bg-red-500 hover:bg-red-700 btn m-1" @click="userDestroy(user.id)">
                                Delete user
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>



            <div class="my-4">
                <template v-for="link in users.meta.links">
                    <Link v-if="link.url" :href="link.url" v-html="link.label" class="ml-2 p-2 bg-neutral-300 rounded-md"
                        style="color: #0b0b0a; font-weight: bold; border: 2px solid black ;">
                    </Link>
                    <span v-else v-html="link.label" class="ml-2 p-2 bg-black rounded-md"
                        style="color: #ffffff; font-weight: bold; border: 2px solid rgb(255, 255, 255) ;"></span>
                </template>
            </div>




            <hr class="text-gray-900 font-bold my-3" />
            <Link
                class="bg-green-500 hover:bg-green-400 text-white font-bold p-2 border-b-4 border-green-700 hover:border-green-500 rounded w-1/4"
                :href="route('role.create')">
            Create New Role
            </Link>

            <table class="table-auto mt-4 border border-black">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-black">Id</th>
                        <th class="px-4 py-2 border border-black">Name</th>
                        <th class="px-4 py-2 border border-black">guard</th>
                        <th class="px-4 py-2 border border-black">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles" :key="role.id">
                        <td class="px-4 py-2 border border-black">
                            {{ role.id }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ role.name }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ role.guard }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            <Link class="bg-gray-500 hover:bg-gray-700 btn m-1" :href="route('role.edit', role.id)">
                            Edit role
                            </Link>
                            <button class="bg-red-500 hover:bg-red-700 btn m-1" @click="roleDestroy(role.id)">
                                Delete role
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <hr class="text-gray-500 font-bold my-3" />
            <Link
                class="bg-red-500 hover:bg-red-400 text-white font-bold p-2 border-b-4 border-red-700 hover:border-red-500 rounded w-1/4"
                :href="route('permission.create')">
            Create New Permission
            </Link>

            <table class="table-auto mt-4 border border-black">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-black">Id</th>
                        <th class="px-4 py-2 border border-black">Name</th>
                        <th class="px-4 py-2 border border-black">guard</th>
                        <th class="px-4 py-2 border border-black">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="permission in permissions" :key="permission.id">
                        <td class="px-4 py-2 border border-black">
                            {{ permission.id }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ permission.name }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            {{ permission.guard }}
                        </td>
                        <td class="px-4 py-2 border border-black">
                            <Link class="bg-green-500 hover:bg-green-700 btn m-1"
                                :href="route('permission.edit', permission.id)">
                            Edit permission
                            </Link>
                            <button class="bg-red-500 hover:bg-red-700 btn m-1" @click="permissionDestroy(permission.id)">
                                Delete permission
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
