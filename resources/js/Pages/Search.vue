<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryView from '@/Layouts/PrimaryView.vue';


const props = defineProps({
    posts: Array,

});

</script>

<template>
    <Head title="البحث" />
    <PrimaryView >
        <section class="main-content">

            <section class="articles" dir="rtl">

                <div v-for="post in  posts" :key="post.id">
                    <div class="article-card">
                        <img v-if="post.image.startsWith(`https:`)" :src="post.image" :alt="post.title">
                        <img v-else :src="`../../../storage/` + post.image" :alt="post.title">
                        <div class="title">{{ post.title }}</div>
                        <div class="link-div">
                            <a :href="route('article.show', [post.id])" class="button-28">أقرا المزيد ....</a>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </PrimaryView>
</template>

