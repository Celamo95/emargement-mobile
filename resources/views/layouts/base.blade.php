<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Syne:wght@400..800&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
    @stack('styles')
    @stack('scripts')
</head>

<body>
    @yield('content')
    @if(Route::CurrentRouteName() !==('login'));
    <button type="submit"><a href="{{route('login')}}">Déconnexion</a></button>
    @endif

</body>

</html>