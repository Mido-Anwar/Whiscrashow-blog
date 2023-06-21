<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryView from '@/Layouts/PrimaryView.vue';




const props = defineProps({

    post: Object,
    author: String,
    postTags: Object,
    date: String,
});

</script>

<template>
    <Head v-bind:title="post.title" />
    <PrimaryView>
        <section class="article-page">
            <div class="article-container bg-slate-300" dir="rtl">
                <div class="image" v-if="post.image.startsWith(`https:`)">
                    <img :src="post.image" :alt="post.title">
                </div>
                <div class="image" v-else>
                    <img :src="`../../../storage/` + post.image" :alt="post.title">
                </div>
                <div class="articleInfo">
                    <div class="my-4">
                        الناشر : {{ author }}
                    </div>
                    <div class="my-4">
                        تاريخ النشر :{{ date }}
                    </div>
                    <div class="my-4">
                        <Link v-for="tag in postTags" :key="tag.id" style="background-color: #1e1d2a; color: aliceblue;"
                            class="inline rounded p-3 m-1" :href="route('tags', [tag.id])">{{ tag.name }}</Link>
                    </div>

                </div>
                <h1 v-html="post.title" class="title my-5 font-bold text-2xl">

                </h1>

                <p v-html="post.content" class="content my-36 text-sm text-center"></p>

            </div>

        </section>
    </PrimaryView>
</template>
