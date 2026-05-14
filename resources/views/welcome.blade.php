<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <main class="page" hx-boost="true">
            <header class="page__header">
                <h1 class="heading heading--h1">{{ config('app.name', 'Laravel') }}</h1>
                <nav class="page__nav">
                    @auth
                        <a href="{{ url('/admin') }}" class="btn btn--ghost">Admin</a>
                    @else
                        <a href="{{ route('filament.admin.auth.login') }}" class="btn btn--ghost">Log in</a>
                    @endauth
                </nav>
            </header>
            <section class="page__body">
                <p class="text">Welcome. Start by creating pages in the admin panel.</p>
                <a href="{{ url('/admin') }}" class="btn btn--primary">Go to Admin →</a>
            </section>
        </main>
    </body>
</html>
