<?php

use App\Http\Controllers\PageController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $home = Page::where('is_home', true)->first();

    if ($home) {
        return app(PageController::class)->show($home);
    }

    return view('welcome');
});

Route::get('/{page:slug}', [PageController::class, 'show'])->name('pages.show');
