<?php

declare(strict_types=1);

use App\Http\Controllers\LoginUser;
use App\Http\Controllers\RegisteredUser;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/register', [RegisteredUser::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisteredUser::class, 'store'])->middleware('guest');

Route::get('/login', [LoginUser::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginUser::class, 'store'])->middleware('guest');

Route::get('/logout', [LoginUser::class, 'destroy'])->name('logout')->middleware('auth');
