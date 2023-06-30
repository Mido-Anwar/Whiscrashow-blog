<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import AboutMe from '@/Components/AboutMe.vue';
import Privacy from '@/Components/Privacy.vue';
import { useRoles } from "@/composables/roles";


const props = defineProps({
    //  canLogin: Boolean,
    //canRegister: Boolean,
    posts: Array,
    categories: Array,
});
// search method
let search = ref('');
watch(search, value => {
    router.get('/search', { search: value }, { preserveState: true });
});
// contact send message method
//const submit = () => {
//    form.post(route('contact'), {
//        onFinish: () => form.reset('email', 'name', 'message'),
//    });
//}
// user roles
const { hasRole } = useRoles();
// great idea thank you vue.js dropdown list
const showingNavigationDropdown = ref(false);
</script>
<template>
    <!--  main navbar of welcome page -->
    <nav class="navbar" lang="ar" dir="rtl" id="navbar">
        <div class="links">
            <!-- main list button -->
            <button @click="showingNavigationDropdown = !showingNavigationDropdown" id="menu" aria-label="login menu">
                <svg class="h-9 w-9" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{
                        hidden: showingNavigationDropdown,
                        'inline-flex': !showingNavigationDropdown,
                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{
                        hidden: !showingNavigationDropdown,
                        'inline-flex': showingNavigationDropdown,
                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>

            </button>
            <!-- main dropdown-->
            <div v-if="$page.props.canLogin" id="auth" class="auth"
                :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }">
                <div class="search">
                    <label for="search" value="Search" class="text-sm text-white"></label>
                    <input type="search" name="" id="search" v-model="search" placeholder="إبحث بعنوان المقال" />
                </div>
                <hr class="my-3 text-slate-50">
                <div v-if="$page.props.auth.user">
                    <Link :href="route('profile.edit')" class="link">
                    الملف الشخصي
                    </Link>


                    <Link v-if="hasRole('Admin')" :href="route('dashboard')" class="link">
                    Dashboard
                    </Link>


                    <Link :href="route('logout')" method="post" as="button" class="link">
                    خروج
                    </Link>
                </div>

                <template v-else>
                    <div class="">
                        <Link :href="route('login')" class="link">
                        تسجيل دخول
                        </Link>

                        <Link v-if="$page.props.canRegister" :href="route('register')" class="link">
                        حساب جديد
                        </Link>
                    </div>
                </template>

                <hr class="my-3 text-slate-50">
                <!--responsive category links-->
                <div class="categories-link">
                    <Link v-for="category in categories" :key="category.id" :href="route('categories', [category.id])"
                        class="link">{{ category.name }}</Link>
                </div>
            </div>
        </div>
        <!--main category links-->
        <div class="categories">

            <Link v-for="category in $page.props.categories" :key="category.id" :href="route('categories', [category.id])" class="mx-3">
            {{ category.name }}
            </Link>



        </div>
        <!--logo -->
        <div class="logo">
            <div class="Whiscrashaw">
                <Link :href="route('welcome')">
                Whiscrashow
                </Link>
            </div>
        </div>

    </nav>

    <!-- Page Content -->
    <main>
        <slot />
    </main>

    <footer dir="rtl">
        <div class="collect">
            <AboutMe />
            <Privacy />

        </div>


        <div class="contactme">
            <h2>للتواصل معنا</h2>
            <div class="social">
                <a href="https://github.com/Mido-Anwar" aria-label="github" class="fa-brands fa-github fa-2xl mx-1"
                    style="color: #e16c06;"></a>
                <a href="https://www.linkedin.com/in/ahmed-anwar-119527174" aria-label="linkedin"
                    class="fa-brands fa-linkedin fa-2xl mx-1" style="color: #005eff;"></a>
                <a href=" https://wa.me/+0201007204478" aria-label="whatsup"
                    class="fa-brands fa-square-whatsapp fa-2xl mx-1" style="color: #10d113;"></a>
            </div>
        </div>

    </footer>
</template>

