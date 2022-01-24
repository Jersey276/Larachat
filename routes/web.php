<?php

use App\Http\Livewire\TalkDetail;
use App\Http\Livewire\TalkList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', TalkList::class);
Route::get('/{id}', TalkDetail::class);
