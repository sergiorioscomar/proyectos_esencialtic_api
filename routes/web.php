<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/api', 302);
Route::get('/reset-password/{token}', function ($token) {
    return redirect("https://porfolio.esencialtic.com.ar/reset-password?token={$token}&email=" . request('email'));
})->name('password.reset');
