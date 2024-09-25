<!doctype html>
<html lang="{{app()->getLocale()}}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    @vite(['resources/js/app.js','resources/css/app.css'])
    {!! SEO::generate(true) !!}
</head>
<body>
@yield('content')
</body>
</html>
