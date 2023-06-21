<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Whiscrashow blog for web devolopment. php javascript frontend backend ui/ux laravel mysql docker inertiajs Vuejs sass css html arabic content لارافيل جافا سكريبت قواعد البيانات الواجهة الامامية .">
        <title inertia>{{ config('app.name', 'Whiscrashow') }}</title>
        <script src="https://cdn.tiny.cloud/1/az1dyax66x07uneuuxzi6xos9oh0r277imflde417td7p4z5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
            tinymce.init({
              selector: 'textarea',
              plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
              toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
          </script>
    </body>
</html>
