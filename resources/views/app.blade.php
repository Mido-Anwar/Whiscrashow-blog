<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Whiscrashow blog for web devolopment. php javascript frontend backend ui/ux laravel mysql docker inertiajs Vuejs sass css html arabic content لارافيل جافا سكريبت قواعد البيانات الواجهة الامامية .">
        <title inertia>{{ config('app.name', 'Whiscrashow') }}</title>
        <!-- Scripts -->
        @routes
        @vite([
             'resources/js/app.js','resources/sass/app.scss',
             "node_modules/@splidejs/vue-splide/dist/css/splide-core.min.css",
             "node_modules/@splidejs/vue-splide/dist/css/themes/splide-skyblue.min.css",
            "node_modules/@fortawesome/fontawesome-free/css/all.min.css",
             "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        <script>

          </script>
    </body>
</html>
