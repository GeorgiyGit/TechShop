<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TechnoWorld' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(array_merge([
        'resources/css/products.css',
        'resources/css/home.css',
        'resources/css/login.css',
        'resources/css/signup.css',
        'resources/js/products.js',
    ], $vite ?? []))
</head>

@php
    $authModal = $errors->any() ? (old('name') !== null ? 'signup' : 'login') : '';
    $returnTo = request()->fullUrl();
@endphp

<body class="@yield('bodyClass')">
    @yield('content')

    @include('partials.auth-modals', ['authModal' => $authModal, 'returnTo' => $returnTo])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @if ($authModal)
        <script>new bootstrap.Modal(document.getElementById('{{ $authModal }}Modal')).show();</script>
    @endif
</body>

</html>
