<?php

use App\Http\Controllers\ControllerUser;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ControllerUser::class, 'index'])->name('task.index');

Route::resource('task', ControllerUser::class)->only([
    'store',
    'update',
    'destroy',
]);
