<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EncodeExpensesController;
use App\Http\Controllers\PettyCashController;
use App\Http\Controllers\ExpensesController;

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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';











  Route::get('/home', [PettyCashController::class, 'index'])->name('home');

  //Route::get('/home', [EncodeExpensesController::class, 'Home'])->name('home');

  
  Route::get('/expenses_view/{id}', [EncodeExpensesController::class, 'ExpensesView'])->name('expenses.view');
  Route::get('/expenses_edit/{id}', [EncodeExpensesController::class, 'ExpensesEdit'])->name('expenses.edit');

  Route::post('/expenses_add', [EncodeExpensesController::class, 'ExpensesAdd'])->name('expenses.add')->middleware('admin');
  Route::get('/expenses_delete/{id}', [EncodeExpensesController::class, 'ExpensesDelete'])
  	->name('expenses.delete')->middleware('admin');


  Route::post('/cash_in', [EncodeExpensesController::class, 'CashIn'])->name('cash.in')->middleware('admin');
  Route::get('/cash_in_delete/{id}', [EncodeExpensesController::class, 'CashIndDelete'])
  	->name('cash.in.delete')->middleware('admin');

    Route::post('/cash_out', [EncodeExpensesController::class, 'CashOut'])->name('cash.out')->middleware('admin');

Route::get('/cash_out_close/{id}', [EncodeExpensesController::class, 'CashOutClose'])->name('cash.out.close')->middleware('admin');

    Route::get('/petty_cash_add', [EncodeExpensesController::class, 'PettyCashAdd'])->name('petty.cash.add')->middleware('admin');


    Route::get('/export_excel/{id}', [EncodeExpensesController::class, 'ExportExcel'])->name('export.excel');

     Route::get('/generate_pettycash/{id}', [EncodeExpensesController::class, 'GeneratePettyCash'])->name('generate.pettycash')->middleware('admin');


       Route::post('/picture', [EncodeExpensesController::class, 'Picture'])->name('picture');

             Route::get('/picture_delete', [EncodeExpensesController::class, 'PictureDelete'])->name('picture.delete');