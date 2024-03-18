<?php

use Illuminate\Support\Facades\Route;
use RedDotDigitalIT\DynamicJoin\Http\Controllers\JoinController;
use RedDotDigitalIT\DynamicJoin\Http\Controllers\ReportController;
use RedDotDigitalIT\DynamicJoin\Http\Controllers\ViewReportListController;


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

Route::get('/create-report', [JoinController::class, 'index'])->name('adminViewCreate.index');
Route::post('/create-report/fetch', [JoinController::class, 'fetch'])->name('adminViewCreate.fetch');
Route::post('/create-report/fetch_datas', [JoinController::class, 'fetch_datas'])->name('adminViewCreate.fetch_datas');
Route::post('/create-report/fetch_join_datas', [JoinController::class, 'fetch_join_datas'])->name('adminViewCreate.fetch_join_datas');
Route::post('/create-report', [JoinController::class, 'processForm'])->name('adminViewCreate.processForm');

Route::get('/view-report/{id}', [ReportController::class, 'showData'])->name('viewReport.index');
Route::get('/view-report/{id}/delete', [ReportController::class, 'destroy']);
Route::get('/view-report/{id}/edit', [ReportController::class, 'edit'])->name('adminViewCreate.edit');
Route::post('/view-report/{id}/edit', [ReportController::class, 'editForm'])->name('adminViewCreate.editForm');
Route::post('/view-report/edit/fetch', [JoinController::class, 'fetch'])->name('adminViewCreate.fetch');

Route::get('/view-report-list', [ViewReportListController::class, 'index']);