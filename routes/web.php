<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('logout',[]);
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard',[DashboardController::class,'show'])->middleware(['auth','verified'])->name('dashboard');
Route::post('/dashboard/post',[DashboardController::class,'show'])->middleware(['auth'])->name('dashboard.search');

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
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
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
Route::post('income/delete/{id}',[IncomeController::class,'destroy'])->name('income.delete');



Route::get('expenses',[ExpenseController::class,'index']);
Route::get('expenses/create',[ExpenseController::class,'create'])->name('expenses.create');
Route::post('expenses/store',[ExpenseController::class,'store'])->name('expenses.store');
Route::get('expenses/show',[ExpenseController::class,'show'])->name('expenses.show');
Route::get('expenses/edit/{id}',[ExpenseController::class,'edit'])->name('expenses.edit');
Route::post('expenses/update',[ExpenseController::class,'update'])->name('expenses.update');
Route::post('expenses/delete/{id}',[ExpenseController::class,'destroy'])->name('expenses.delete');



Route::get('budget',[BudgetController::class,'index'])->name('budget.index');
Route::get('budget/create',[BudgetController::class,'create'])->name('budget.create');
Route::post('budget/store',[BudgetController::class,'store'])->name('budget.store');
Route::get('budget/edit/{id}',[BudgetController::class,'edit'])->name('budget.edit');
Route::post('budget/update',[BudgetController::class,'update'])->name('budget.update');
Route::post('budget/delete/{id}',[BudgetController::class,'destroy'])->name('budget.delete');


require __DIR__.'/auth.php';
