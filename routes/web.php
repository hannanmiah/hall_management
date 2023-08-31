<?php

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

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

Route::get('invoice/{invoice}/pdf', function (Invoice $invoice) {
    $pdf = PDF::loadView('pdf.invoice', compact('invoice'))->setPaper('a4');

    return $pdf->download('invoice-'.$invoice->uuid.'-'.now()->toDateTimeString().'.pdf');
})->name('invoice.pdf');

Route::get('invoice/{invoice}/view', function (Invoice $invoice) {
    return view('pdf.invoice', compact('invoice'));
})->name('invoice.view');

Route::get('invoices', function () {
    $invoices = Invoice::query()->paginate(10);

    return view('invoices', compact('invoices'));
})->name('invoices');
