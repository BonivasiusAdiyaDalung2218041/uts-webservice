<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookService;

Route::get('/books', [BookService::class, 'index']);
Route::get('/books/{id}', [BookService::class, 'show']);
Route::post('/books', [BookService::class, 'store']);
Route::put('/books/{id}', [BookService::class, 'update']);
Route::delete('/books/{id}', [BookService::class, 'destroy']);
