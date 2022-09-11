<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Mail\mailUsage;
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



Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::resource('product', ProductController::class);
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::get('/', function () {
        return redirect('/home'); // j'ai fait des changements apres ce lien  est resté libre j'allais changer /home avec mais ca provoque beaucoup de changement alors j'ai prefere cette solution
    });

    Route::get('/email',function(){
        return new mailUsage();
    });

    Route::Post('/search',[ ProductController::class, 'search'])->name('search');

});