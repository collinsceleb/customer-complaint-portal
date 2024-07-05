<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Mail\NewCustomerCreated;
use Illuminate\Support\Facades\Mail;
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

    Route::resource('customers', CustomerController::class);
    Route::resource('managers', ManagerController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('complaints', ComplaintController::class);
});

Route::get('/sendTest', function () {
    Mail::to('hulk@marvel.com')->send(new NewCustomerCreated('Bruce Banner'));
    dump('Email was sent!');
});


require __DIR__.'/auth.php';
