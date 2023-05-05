<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';


defineProps({
    type: {
        type: String,
        default: 'button',
    },
});

const aboutMe = ref(false);
</script>
<template>
    <div class="aboutme">
        <div class="title">
            <button @click="aboutMe = !aboutMe" :type="type"> من نحن</button>
        </div>
        <div class="content" v-if="aboutMe">
            <div>
                تطبيق(
                <Link class="Whiscrashaw">
                Whiscrashaw
                </Link>
                ) تعليمي ويهدف لنشر علوم الحاسب و تبسيط مفاهيمها و ندعو الله التوفيق والهداية و نسالكم الدعاء

            </div>
        </div>

    </div>
</template>
