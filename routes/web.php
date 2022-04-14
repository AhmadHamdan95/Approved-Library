<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Authors\AuthorController;
use App\Http\Controllers\Admin\Books\BookController;
use App\Http\Controllers\Admin\Cart\CartController;
use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Publishers\PublisherController;
use App\Http\Controllers\Admin\Sliders\SliderController;
use App\Http\Controllers\Admin\Users\UserChangePasswordController;
use App\Http\Controllers\Admin\Users\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/master', 'admin.layout.master');

Route::prefix('/admin')->name('admin.')->middleware('guest:admin')->group(function(){
    Route::get('/login-page', [LoginController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
});

Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function(){

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/editPassword', [UserChangePasswordController::class, 'edit'])->name('users.editPassword');
    Route::put('/users/updatePassword', [UserChangePasswordController::class, 'update'])->name('users.updatePassword');

    Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/publishers/index', [PublisherController::class, 'index'])->name('publishers.index');
    Route::get('/publishers/create', [PublisherController::class, 'create'])->name('publishers.create');
    Route::post('/publishers/store', [PublisherController::class, 'store'])->name('publishers.store');
    Route::get('/publishers/edit/{id}', [PublisherController::class, 'edit'])->name('publishers.edit');
    Route::put('/publishers/update/{id}', [PublisherController::class, 'update'])->name('publishers.update');
    Route::get('/publishers/destroy/{id}', [PublisherController::class, 'destroy'])->name('publishers.destroy');

    Route::get('/authors/index', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/authors/edit/{id}', [AuthorController::class, 'edit'])->name('authors.edit');
    Route::put('/authors/update/{id}', [AuthorController::class, 'update'])->name('authors.update');
    Route::get('/authors/destroy/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');

    Route::get('/authors/publishers/{id}', [AuthorController::class, 'getPublishers'])->name('authors.publishers');
    // Route::post('/authors/addPublishers', [AuthorController::class, 'addPublishers'])->name('authors.addPublishers');
    Route::get('/authors/deletePublisher/{author}/{id}', [AuthorController::class, 'deletePublisher'])->name('authors.deletePublisher');
  
    Route::get('/publishers/authors/{id}', [PublisherController::class, 'getAuthors'])->name('publishers.authors');
    // Route::post('/publishers/addAuthors', [PublisherController::class, 'addAuthors'])->name('publishers.addAuthors');
    Route::get('/publishers/deleteAuthor/{publisher}/{id}', [PublisherController::class, 'deleteAuthor'])->name('publishers.deleteAuthor');

    Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/update/{id}', [BookController::class, 'update'])->name('books.update');
    Route::get('/books/destroy/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    
    Route::get('/customers/index', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/destroy/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/sliders/index', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::post('/sliders/store', [SliderController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/update/{id}', [SliderController::class, 'update'])->name('sliders.update');
    Route::get('/sliders/destroy/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
});