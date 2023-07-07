<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryView from '@/Layouts/PrimaryView.vue';
import { router } from '@inertiajs/vue3';
import { useRoles } from "@/composables/roles";


const props = defineProps({

    tagsPosts: Object,
    categories :Array,

});
/// favorites needed

const {favorite } = useRoles();
const { unFavorite } = useRoles();

</script>
<template>
    <Head title="مقالات الوسم" />
    <PrimaryView v-bind:categories="categories">
        <section class="main-content">

            <section class="articles bg-slate-300" dir="rtl">


                <div class="article-card" v-for="post in tagsPosts.data" :key="post.id">
                    <img v-if="post.image.startsWith(`https:`)" :src="post.image" :alt="post.title">
                    <img v-else :src="`../../../storage/` + post.image" :alt="post.title">
                    <span v-if="$page.props.auth.user" style="align-self: start;">
                        <a href="#" v-if="post.postFavorite == false" @click.prevent="favorite(post.id)">
                            <i class="fa-regular fa-heart mx-2"></i>القراءة لاحقا
                        </a>
                        <a href="#" v-else @click.prevent="unFavorite(post.id)">
                            <i class="fa-solid fa-heart mx-2"></i>ازالة من القائمة
                        </a>
                    </span>
                    <div class="title">{{ post.title }}</div>
                    <a :href="route('article.show', [post.id])" class="button-28">أقرا المزيد ....</a>
                </div>

            </section>

            <div class="my-4 ">
                <!--posts pagination -->
                <template v-for="link in tagsPosts.links">
                    <Link v-if="link.url" :href="link.url" v-html="link.label" class="ml-2 p-2 bg-neutral-300 rounded-md"
                        style="color: #0b0b0a; font-weight: bold; border: 2px solid black ;">
                    </Link>
                    <span v-else v-html="link.label" class="ml-2 p-2 rounded-md"   style="color: #ffffff;background-color: #1e1d2a; font-weight: bold; border: 2px solid rgb(250, 250, 250) ;"></span>
                </template>

            </div>

        </section>

    </PrimaryView>
</template>
