<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Task;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'localization'], function () {
    Route::resource('tasks', TaskController::class);
    Route::resource('users', UserController::class);
    Route::get('change-language/{locale}', function ($locale) {
        $lang = $locale;
        $language = config('app.locale');
        if ($lang == 'en') {
            $language = 'en';
        }
        if ($lang == 'vi') {
            $language = 'vi';
        }
        Session::put('language', $language);

        return redirect()->back();
    })->name('change-language');
});
