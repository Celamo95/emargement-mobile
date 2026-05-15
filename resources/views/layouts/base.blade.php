<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
    @stack('styles')
    @stack('scripts')
</head>

<body style="background:#f0f4ff; min-height:100vh; font-family:'Lato',sans-serif;">

    @yield('content')

    @auth
    <div style="text-align:center; padding:20px;">
        <a href="{{ route('logout') }}" style="display:inline-block; background:#006cb1; color:white; padding:12px 40px; border-radius:8px; text-decoration:none; font-weight:600;">
            Se déconnecter
        </a>
    </div>
    @endauth

</body>

</html>