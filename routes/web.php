<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('transactions',TransactionController::class)->names([
    'index'=>'transactions',
    'create'=>'transactions.create',
    'store'=>'transactions.store',
    'show'=>'transactions.show',
    'edit'=>'transactions.edit',
    'update'=>'transactions.update',
    'destroy'=>'transactions.delete',
]);

Route::resource('categories',CategoryController::class)->names([
   'index'=>'categories',
   'create'=>'categories.create',
   'store'=>'categories.store',
   'show'=>'categories.show',
   'edit'=>'categories.edit',
   'update'=>'categories.update',
   'destroy'=>'categories.delete'
]);


Route::post('categories/store', [CategoryController::class,'store']);


require __DIR__.'/auth.php';
