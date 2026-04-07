<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('customers.index');
});

Route::get('/users', function () {
    $users = User::query()->latest('id')->paginate(15);

    return view('users.index', compact('users'));
})->name('users.index');

Route::resource('customers', CustomerController::class)->except('show');
Route::resource('invoices', InvoiceController::class)->except('show');

Route::fallback(function () {
    return redirect()->route('customers.index');
});
