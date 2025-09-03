<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/starter', function () {return view('layouts/starter');});

// Routes that require authentication
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*category routes*/
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/edit/{slug}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

    /*sub-category routes*/
    Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::delete('/subcategory/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
    Route::get('/subcategory/edit/{slug}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');

    /*income routes*/
    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/get-subcategories', [IncomeController::class, 'getSubCategories'])->name('get.subcategories');
    Route::post('/income', [IncomeController::class, 'store'])->name('income.store');
    Route::delete('/income/{income}', [IncomeController::class, 'destroy'])->name('income.destroy');
    Route::get('/income/edit/{income_id}', [IncomeController::class, 'edit'])->name('income.edit');
    Route::put('/income/{income_id}', [IncomeController::class, 'update'])->name('income.update');

    /*expense routes*/
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store');
    Route::delete('/expense/{expense}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
    Route::get('/expense/edit/{expense_id}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('/expense/{expense_id}', [ExpenseController::class, 'update'])->name('expense.update');

    /*report routes*/
    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
    Route::get('/dailyReport', [ReportController::class, 'dailyReport'])->name('dailyReport');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
