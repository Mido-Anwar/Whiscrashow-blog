<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, Link } from '@inertiajs/vue3';



defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    userPosts: Object,
});
const favorite = (post) => {
    router.post(`/favorite/${post}`);
};

const unFavorite = (post) => {
    router.post(`/unfavorite/${post}`);
};

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 dir="rtl" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">الملف الشخصي</h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" dir="rtl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">المقالات المفضلة</h2>

                    <div class="article-card border my-3 bg-slate-500" v-for="post in userPosts.target" :key="post.id">
                        <span v-if="$page.props.auth.user" style="align-self: start;">
                            <a href="#" v-if="post.postFavorite == false" @click.prevent="favorite(post.id)">
                                <i id="like" class="fa-regular fa-heart mx-2"></i>القراءة لاحقا
                            </a>
                            <a href="#" v-else @click.prevent="unFavorite(post.id)">
                                <i class="fa-solid fa-heart mx-2"></i>ازالة من القائمة
                            </a>
                        </span>
                        <div class="title">{{ post.title }}</div>

                        <Link :href="route('article.show', [post.id])" class="button-28">أقرا المزيد ....</Link>
                    </div>

                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
