<script setup>
import PrimaryView from '@/Layouts/PrimaryView.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Splide, SplideSlide } from '@splidejs/vue-splide';


defineProps({
    posts: Object,
    sliders: Array,
    categories :Array,
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
    <Head title="Welcome" />
    <PrimaryView v-bind:categories="categories">
        <div class="main-content" v-lazy-container="{ selector: 'img' }">

            <!--slider section-->
            <section class="slider" >
                <Splide :options="{
                    type: 'fade',
                    perPage: 1,
                    gap: 0,
                    padding: 0,
                    margin: 0,
                    rewind: false,
                    width: '80vw',
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

                <div class="article-card" v-for="post, index in posts.data" :key="index" >
                    <img v-if="post.image.startsWith(`https:`)" :src="post.image" :alt="post.title">
                    <img v-else :src="`../../../storage/` + post.image" :alt="post.title">
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

            </section>

            <div class="my-4">
                <!--posts pagination -->
                <template v-for="link in posts.meta.links">
                    <Link v-if="link.url" :href="link.url" v-html="link.label" class="ml-2 p-2 bg-neutral-300 rounded-md"
                        style="color: #0b0b0a; font-weight: bold; border: 2px solid black ;">
                    </Link>
                    <span v-else v-html="link.label" class="ml-2 p-2 rounded-md"
                        style="color: #ffffff; font-weight: bold;background-color: #1e1d2a; border: 2px solid rgb(255, 255, 255) ;">
                    </span>
                </template>

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
