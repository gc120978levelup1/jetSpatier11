<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DoctypeController;
use App\Http\Controllers\DocapprovalguideController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SupportingdocumentController;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//blanket route with middle ware
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('doctypes', DoctypeController::class);
    Route::resource('docapprovalguides', DocapprovalguideController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('supportingdocuments', SupportingdocumentController::class);
    Route::resource('documenttrails', SupportingdocumentController::class);
});

//custom routes
Route::get('/docapprovalguides/create?doctype_id={doctype_id}', [DocapprovalguideController::class, 'create'])->middleware('auth');
Route::get('/docapprovalguides/index?doctype_id={doctype_id}', [DocapprovalguideController::class, 'index'])->middleware('auth');
Route::patch('/documents/submit/{document_id}', [DocumentController::class, 'submit'])->middleware('auth')->name('documents.submit');
Route::patch('/documents/cancel/{document_id}', [DocumentController::class, 'cancel'])->middleware('auth')->name('documents.cancel');
Route::get('/supportingdocuments/create?document_id={document_id}', [SupportingdocumentController::class, 'create'])->middleware('auth')->name('supportingdocuments.create');
//Route::get('/supportingdocuments/index?document_id={document_id}', [SupportingdocumentController::class, 'index'])->middleware('auth')->name('supportingdocuments.index');
