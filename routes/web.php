<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriptionPlanController;
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

Route::group([
    "prefix" => "companies",
    "as" => "companies.",
], function () {
    Route::get("/", [CompanyController::class, 'index'])->name("index");
    Route::get("/{id}/detail", [CompanyController::class, 'show'])->name("show");
    Route::get("/create", [CompanyController::class, 'create'])->name("create");
    Route::post("/store", [CompanyController::class, 'store'])->name("store");
    Route::get("/{id}/edit", [CompanyController::class, 'edit'])->name("edit");
    Route::post("/{id}/update", [CompanyController::class, 'update'])->name("update");
    Route::post("/{id}/delete", [CompanyController::class, 'delete'])->name("delete");
});

Route::group([
    "prefix" => "contacts",
    "as" => "contacts.",
], function () {
    Route::get("/", [ContactController::class, 'index'])->name("index");
    Route::get("/{id}/detail", [ContactController::class, 'show'])->name("show");
    Route::get("/create", [ContactController::class, 'create'])->name("create");
    Route::post("/store", [ContactController::class, 'store'])->name("store");
    Route::get("/{id}/edit", [ContactController::class, 'edit'])->name("edit");
    Route::post("/{id}/update", [ContactController::class, 'update'])->name("update");
    Route::post("/{id}/delete", [ContactController::class, 'delete'])->name("delete");
});

Route::group([
    "prefix" => "subscription-plans.",
    "as" => "subscription-plans.",
], function () {
    Route::get("/", [SubscriptionPlanController::class, 'index'])->name("index");
    Route::get("/{id}/detail", [SubscriptionPlanController::class, 'show'])->name("show");
    Route::get("/create", [SubscriptionPlanController::class, 'create'])->name("create");
    Route::post("/store", [SubscriptionPlanController::class, 'store'])->name("store");
    Route::get("/{id}/edit", [SubscriptionPlanController::class, 'edit'])->name("edit");
    Route::post("/{id}/update", [SubscriptionPlanController::class, 'update'])->name("update");
    Route::post("/{id}/delete", [SubscriptionPlanController::class, 'delete'])->name("delete");
});