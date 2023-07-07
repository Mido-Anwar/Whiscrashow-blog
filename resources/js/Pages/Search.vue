<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryView from '@/Layouts/PrimaryView.vue';
import { router } from '@inertiajs/vue3';
import { useRoles } from "@/composables/roles";

const props = defineProps({
    posts: Array,
    message: String,
    categories :Array,


});
/// favorites needed from "@/composables/roles"

const {favorite } = useRoles();
const { unFavorite } = useRoles();
</script>

<template>
    <Head title="البحث" />
    <PrimaryView v-bind:categories="categories">
        <section class="main-content">

            <section class="articles" dir="rtl">
                <div v-if="posts.length > 0"  v-for="post in  posts" :key="post.id">
                    <div class="article-card">
                        <img v-if="post.image.startsWith(`https:`)" :src="post.image" :alt="post.title">
                        <img v-else :src="`../../../storage/` + post.image" :alt="post.title">
                        <div class="title">{{ post.title }}</div>
                        <span v-if="$page.props.auth.user" style="align-self: start;">
                        <a href="#" v-if="post.postFavorite == false" @click.prevent="favorite(post.id)">
                            <i id="like" class="fa-regular fa-heart mx-2"></i>القراءة لاحقا
                        </a>
                        <a href="#" v-else @click.prevent="unFavorite(post.id)">
                            <i class="fa-solid fa-heart mx-2"></i>ازالة من القائمة
                        </a>
                    </span>
                        <div class="link-div">
                            <a :href="route('article.show', [post.id])" class="button-28">أقرا المزيد ....</a>
                        </div>
                    </div>
                </div>
                <div v-else class="w-1/2 my-5 bg-slate-600 text-white"
                    style="height: 550px; display: flex; justify-content: center; align-items: center;">
                    <p class=" text-2xl ">
                       عفوا لا يوجد مقال بهذا العنوان

                    </p>
                </div>
            </section>
        </section>
    </PrimaryView>
</template>

