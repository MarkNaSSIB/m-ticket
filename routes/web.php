<?php

declare(strict_types=1);

use App\Http\Controllers\LoginUser;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RegisteredUser;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/register', [RegisteredUser::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisteredUser::class, 'store'])->middleware('guest');

Route::get('/login', [LoginUser::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [LoginUser::class, 'store'])->middleware('guest');

Route::get('/logout', [LoginUser::class, 'destroy'])->name('logout')->middleware('auth');

Route::get('/tickets', [TicketController::class, 'index'])->name('ticket.index')->middleware('auth');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('ticket.show')->middleware('auth');
Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('ticket.edit')->middleware('auth');
Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('ticket.destroy')->middleware('auth');

Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store')->middleware('auth');
Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create')->middleware('auth');

Route::post('/tickets/{ticket}/notes', [NoteController::class, 'store'])->name('note.store')->middleware('auth');
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('note.destroy')->middleware('auth');
