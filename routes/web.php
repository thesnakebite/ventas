<?php

use App\Livewire\Home\Inicio;
use App\Livewire\User\UserShow;
use App\Livewire\User\UserComponent;
use App\Livewire\Product\ProductShow;
use Illuminate\Support\Facades\Route;
use App\Livewire\Category\CategoryShow;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Category\CategoryComponent;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/inicio', Inicio::class)->name('inicio')->middleware(['auth']);
Route::get('/categorias', CategoryComponent::class)->name('categories')->middleware(['auth']);
Route::get('/categorias/{category}', CategoryShow::class)->name('categories.show')->middleware(['auth']);
Route::get('/productos', ProductComponent::class)->name('products')->middleware(['auth']);
Route::get('/productos/{product}', ProductShow::class)->name('products.show')->middleware(['auth']);
Route::get('/usuarios', UserComponent::class)->name('users')->middleware(['auth']);
Route::get('/usuarios/{user}', UserShow::class)->name('users.show')->middleware(['auth']);
