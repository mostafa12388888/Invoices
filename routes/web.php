<?php
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\customer_Repot;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\DetailsInvoicesController;
use App\Http\Controllers\InoviceAttachmentController;
use App\Http\Controllers\ArctiveInvoicesController;
use App\Http\Controllers\Home_page;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});


Route::get('/index',[Home_page::class,'index'] )->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/invoicesgroup',InvoicesController::class)->middleware(['auth', 'verified']);
Route::get('/ststusInvoices/{id}',[InvoicesController::class,'show'])->middleware(['auth', 'verified']);
Route::get('/ststusInvoices/{id}',[InvoicesController::class,'show'])->middleware(['auth', 'verified']);
Route::get('/print_invoices/{id}',[InvoicesController::class,'print_invoices'])->middleware(['auth', 'verified']);
Route::get('/invoicespaid',[InvoicesController::class,'invoicespaid'])->middleware(['auth', 'verified']);

Route::get('/invoicesnotpaid',[InvoicesController::class,'invoicesnotpaid'])->middleware(['auth', 'verified']);
Route::get('/invoicespicepaid',[InvoicesController::class,'invoicespicepaid']);
Route::get('/edit_invoice/{id_invoices}',[InvoicesController::class,'edit']);
Route::resource('/sections',SectionController::class)->middleware(['auth', 'verified']);
Route::resource('/products',ProductsController::class);
Route::resource('/intoarchive',ArctiveInvoicesController::class)->middleware(['auth', 'verified']);

Route::get('/getdatafrom-database/{id}',[InvoicesController::class, 'getproudects']);
Route::get('/exportsinvoices',[InvoicesController::class, 'export'])->middleware(['auth', 'verified']);
Route::post('/ststusInvoicesform',[InvoicesController::class, 'status_update'])->middleware(['auth', 'verified']);
Route::get('/read_all',[InvoicesController::class, 'markAsread']);
Route::resource('/delet_file',InoviceAttachmentController::class)->middleware(['auth', 'verified']);
Route::get('/details-Invoices/{id}',[DetailsInvoicesController::class,'index']);
Route::get('/show/{id}/{name}',[DetailsInvoicesController::class,'shown']);
Route::get('/download/{id}/{name}',[DetailsInvoicesController::class,'downloaded']);
Route::get('/invoices-report',[Invoices_Report::class,'index'])->middleware(['auth', 'verified']);
Route::post('/Search_invoices',[Invoices_Report::class,'Search_invoices']);
Route::post('/Search_customers',[customer_Repot::class,'Search_customers'])->middleware(['auth', 'verified']);
Route::get('/customer_Repot',[customer_Repot::class,'index'])->middleware(['auth', 'verified']);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
});
require __DIR__.'/auth.php';

Route::resource('/{page}',AdminController::class);
