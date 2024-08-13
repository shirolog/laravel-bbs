<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/threads', [ThreadController::class, 'index'])
->name('index');

Route::post('/threads', [ThreadController::class, 'store'])
->name('thread.store');
Route::get('/threads/show/{thread}', [ThreadController::class, 'show'])
->name('thread.show');

Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])
->name('thread.destroy');


Route::post('/threads/show/{thread}', [ReplyController::class, 'store'])
->name('reply.store');
Route::delete('/threads/show/{thread}/{reply}', [ReplyController::class, 'destroy'])
->name('reply.destroy');