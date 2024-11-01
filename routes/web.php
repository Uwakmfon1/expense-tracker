<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
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


Route::get('categories', [CategoryController::class,'index']);
Route::get('categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('categories/store',[CategoryController::class,'store']);
Route::get('categories/show',[CategoryController::class,'show']);
Route::get('categories/edit',[CategoryController::class,'edit']);
Route::get('categories/update',[CategoryController::class,'update']);
Route::get('categories/delete',[CategoryController::class,'destroy']);


Route::get('income',[IncomeController::class,'index']);
Route::get('income/create',[IncomeController::class,'create'])->name('income.create');
Route::post('income/store',[IncomeController::class,'store'])->name('income.store');
Route::get('income/show',[IncomeController::class,'show'])->name('income.show');
Route::get('income/edit/{id}',[IncomeController::class,'edit'])->name('income.edit');
Route::post('income/update',[IncomeController::class,'update'])->name('income.update');
//Route::post('income/delete',[IncomeController::class,'destroy'])->name('income.delete');
Route::post('income/delete/{id}',[IncomeController::class,'destroy'])->name('income.delete');



Route::get('expense',[ExpenseController::class,'index']);
Route::get('expense/create',[ExpenseController::class,'create']);
Route::post('expense/store',[ExpenseController::class,'store']);
Route::get('expense/show',[ExpenseController::class,'show']);
Route::get('expense/edit',[ExpenseController::class,'edit']);
Route::get('expense/update',[ExpenseController::class,'update']);
Route::get('expense/delete',[ExpenseController::class,'delete']);




require __DIR__.'/auth.php';
