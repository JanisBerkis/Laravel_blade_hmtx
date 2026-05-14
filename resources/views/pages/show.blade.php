<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $page->title }}</title>
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <main class="page" hx-boost="true">
            <header class="page__header">
                <x-atoms.heading :level="'h1'" :text="$page->title" />
                <x-atoms.button href="/" variant="ghost">
                    ← Home
                </x-atoms.button>
            </header>
            <section class="page__body">
                <x-molecules.content-blocks :blocks="$content" />
            </section>
        </main>
    </body>
</html>
