<script setup>
import PrimaryView from '@/Layouts/PrimaryView.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Splide, SplideSlide } from '@splidejs/vue-splide';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    posts: Object,
    categories: Array,
    sliders: Array,
});
</script>

<template>
    <Head title="Welcome" />
    <PrimaryView v-bind:can-login="canLogin" v-bind:can-register="canRegister">
        <div class="main-content">
            <p>

            </p>

            <!--slider section-->
            <section class="slider">

                <Splide :options="{
                    type: 'fade',
                    perPage: 1,
                    gap: 0,
                    padding: 0,
                    margin: 0,
                    rewind: false,
                    width: '90vw',
                    height: 400,
                    cover: true,
                    interval: 4000,

                }">
                    <SplideSlide v-for="slide in sliders" :key="slide.id">
                        <p style="font-size: 1.7em;">{{ slide.title }}</p>
                        <div class="box">
                            <img v-if="slide.image.startsWith(`https:`)" :src="slide.image" :alt="slide.title">
                            <img v-else :src="`../../../storage/` + slide.image" :alt="slide.title">
                        </div>

                    </SplideSlide>
                </Splide>

            </section>

            <!--articles section-->
            <section class="articles" dir="rtl">

                <div v-for="post, index in posts.data" :key="index">
                    <div class="article-card">
                        <img v-if="post.image.startsWith(`https:`)" :src="post.image" :alt="post.title">
                        <img v-else :src="`../../../storage/` + post.image" :alt="post.title">
                        <span v-if="$page.props.auth.user">
                            <a href="#" v-if="post.postFavorite == false" @click.prevent="favorite(post.id)">
                                <span>
                                    <i id="like" class="fa-regular fa-heart mx-2"></i>القراءة لاحقا
                                </span>
                            </a>
                            <a href="#" v-else @click.prevent="unFavorite(post.id)">
                                <span>
                                    <i class="fa-solid fa-heart mx-2"></i>ازالة من القائمة
                                </span>
                            </a>
                        </span>
                        <div class="title">{{ post.title }}</div>

                        <div class="link-div">
                            <Link :href="route('article.show', [post.id])" class="button-28">أقرا المزيد ....</Link>
                        </div>

                    </div>

                </div>
            </section>

            <div class="mt-4">
                <!--posts pagination -->
                <Link v-for="link in posts.links" :href="link.url" v-html="link.label" :is="link.url ? `Link` : `span`"
                    class="ml-2 p-2 bg-neutral-700 text-gold rounded-md" :class="link.url ? 'text-gold-600' : ''">
                </Link>
            </div>
        </div>
    </PrimaryView>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
