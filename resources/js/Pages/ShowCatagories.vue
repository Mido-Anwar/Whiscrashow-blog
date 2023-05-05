<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryView from '@/Layouts/PrimaryView.vue';
import {router} from '@inertiajs/vue3';


const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    categories: Array,
    categoriesPosts: Array,

});
/// favorites needed

const favorite = (post) => {
    router.post(`/favorite/${post}`);
};

const unFavorite = (post) => {
    router.post(`/unfavorite/${post}`);
};

</script>

<template>
    <Head title="الأقسام" />
    <PrimaryView v-bind:can-login="canLogin" v-bind:can-register="canRegister" v-bind:categories="categories">
        <section class="main-content">

            <section class="articles" dir="rtl">

                <div v-for="post in  categoriesPosts.data" :key="post.id">
                    <div class="article-card">
                        <img v-if="post.image.startsWith(`https:`)" :src="post.image" :alt="post.title">
                        <img v-else :src="`../../../storage/` + post.image" :alt="post.title">
                        <span v-if="$page.props.auth.user">
                            <a href="#" v-if="post.postFavorite == false" @click.prevent="favorite(post.id)">
                                <span >
                                    <i class="fa-regular fa-heart mx-2"></i>القراءة لاحقا
                                </span>
                            </a>
                            <a href="#" v-else @click.prevent="unFavorite(post.id)">
                                <span> <i class="fa-solid fa-heart mx-2"></i>ازالة من القائمة
                                </span>
                            </a>
                        </span>
                        <div class="title">{{ post.title }}</div>
                        <div class="link-div">
                            <a :href="route('article.show', [post.id])" class="button-28">أقرا المزيد ....</a>
                        </div>
                    </div>
                </div>
            </section>

            <div class="mt-4">
                <!--posts pagination -->
                <Link v-for="link in categoriesPosts.links" :href="link.url" v-html="link.label"
                    :is="link.url ? `Link` : `span`" class="ml-2 p-2 bg-neutral-700 text-gold rounded-md"
                    :class="link.url ? 'text-gold-600' : ''">
                </Link>
            </div>

        </section>

    </PrimaryView>
</template>
