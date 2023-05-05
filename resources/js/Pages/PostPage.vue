<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PrimaryView from '@/Layouts/PrimaryView.vue';




const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    post: Object,
    categories: Array,
    posts: Array,
    author: String,
    created_at: String,
    favourite_list: Boolean,
});

</script>

<template>
    <Head v-bind:title="post.title" />
    <PrimaryView v-bind:canLogin="canLogin" v-bind:canRegister="canRegister" v-bind:categories="categories">
        <section class="article-page">
            <div class="article-container " dir="rtl">
                <div class="image" v-if="post.image.startsWith(`https:`)">
                    <img :src="post.image" :alt="post.title">
                </div>
                <div class="image" v-else>
                    <img :src="`../../../storage/` + post.image" :alt="post.title">
                </div>
                <div class="articleInfo">
                    <div>
                        الناشر : {{ author }}
                    </div>
                    <div>
                        تاريخ النشر :{{ created_at }}
                    </div>
                </div>
                <h1 class="title m-3 font-bold text-2xl">
                    {{ post.title }}
                </h1>

                <p v-html="post.content" class="content my-36 text-sm text-center"></p>
                {{ post.id }}
                {{ favourite_list }}
            </div>

        </section>
    </PrimaryView>
</template>
