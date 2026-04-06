<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/loginbetch', function () {
    return view('login');
})->name('login');