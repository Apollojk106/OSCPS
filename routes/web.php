<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/student', function () {
    return view('student');
});

Route::get('/teacher', function () {
    return view('teacher');
});