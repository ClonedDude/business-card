<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExternalLinkController;
use App\Http\Controllers\ExternalLinkTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicContactController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Models\User;
use App\Http\Controllers\SubscriptionPlanRuleController;
use App\Http\Controllers\SubscriptionRuleController;
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

Route::get("/c/{contact_code}", [PublicContactController::class, 'show'])->name("public-contact-detail");
Route::get("/c/{contact_code}/download-vcard", [PublicContactController::class, 'download'])->name("public-download-vcard");

Route::middleware(['2fa'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/test-layout', function () {
        return view('pages.business-card');
    });

    Route::group([
        "prefix" => "companies",
        "as" => "companies.",
    ], function () {
        Route::get("/", [CompanyController::class, 'index'])->name("index");
        Route::get("/data", [CompanyController::class, 'data'])->name("data");
        Route::get("/{id}/detail", [CompanyController::class, 'show'])->name("show");
        Route::get("/create", [CompanyController::class, 'create'])->name("create");
        Route::post("/store", [CompanyController::class, 'store'])->name("store");
        Route::get("/{id}/edit", [CompanyController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [CompanyController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [CompanyController::class, 'delete'])->name("delete");

        Route::group([
            "prefix" => "{id}/users",
            "as" => "users.",
        ], function () {
            Route::get("/", [CompanyUserController::class, 'index'])->name("index");
            Route::get("/create", [CompanyUserController::class, 'create'])->name("create");
            Route::post("/store", [CompanyUserController::class, 'store'])->name("store");
            Route::get("/{user_id}/edit", [CompanyUserController::class, 'edit'])->name("edit");
            Route::post("/{user_id}/update", [CompanyUserController::class, 'update'])->name("update");
            Route::post("/{user_id}/remove", [CompanyUserController::class, 'remove'])->name("remove");
        });
    });

    Route::group([
        "prefix" => "users",
        "as" => "users.",
    ], function () {
        Route::get("/", [UserController::class, 'index'])->name("index");
        Route::get("/data", [UserController::class, 'data'])->name("data");
        Route::get("/{id}/detail", [UserController::class, 'show'])->name("show");
        Route::get("/create", [UserController::class, 'create'])->name("create");
        Route::post("/store", [UserController::class, 'store'])->name("store");
        Route::get("/{id}/edit", [UserController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [UserController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [UserController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "contacts",
        "as" => "contacts.",
    ], function () {
        Route::get("/", [ContactController::class, 'index'])->name("index");
        Route::get("/data", [ContactController::class, 'data'])->name("data");
        Route::get("/{id}/detail", [ContactController::class, 'show'])->name("show");
        Route::get("/{id}/download-vcard", [ContactController::class, 'downloadVCard'])->name("download-v-card");
        Route::get("/create", [ContactController::class, 'create'])->name("create");
        Route::post("/store", [ContactController::class, 'store'])->name("store");
        Route::get("/{id}/edit", [ContactController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [ContactController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [ContactController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "subscription-plans",
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

    Route::group([
        "prefix" => "subscription-plan-rules",
        "as" => "subscription-plan-rules.",
    ], function () {
        Route::get("/{subscription_plan_id}", [SubscriptionPlanRuleController::class, 'index'])->name("index");
        Route::get("/{subscription_plan_id}/create", [SubscriptionPlanRuleController::class, 'create'])->name("create");
        Route::post("/{subscription_plan_id}/store", [SubscriptionPlanRuleController::class, 'store'])->name("store");
        Route::get("/{subscription_plan_id}/edit", [SubscriptionPlanRuleController::class, 'edit'])->name("edit");
        Route::post("/{subscription_plan_id}/update", [SubscriptionPlanRuleController::class, 'update'])->name("update");
    });

    Route::group([
        "prefix" => "orders",
        "as" => "orders.",
    ], function () {
        Route::get("/", [OrderController::class, 'index'])->name("index");
        Route::get("/{id}/detail", [OrderController::class, 'show'])->name("show");
        Route::get("/create", [OrderController::class, 'create'])->name("create");
        Route::post("/store", [OrderController::class, 'store'])->name("store");
        Route::get("/{id}/edit", [OrderController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [OrderController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [OrderController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "subscriptions",
        "as" => "subscriptions.",
    ], function () {
        Route::get("/", [SubscriptionController::class, 'index'])->name("index");
        Route::get("/{id}/detail", [SubscriptionController::class, 'show'])->name("show");
        Route::get("/{id}/edit", [SubscriptionController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [SubscriptionController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [SubscriptionController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "external-link-types",
        "as" => "external-link-types.",
    ], function () {
        Route::get("/", [ExternalLinkTypeController::class, 'index'])->name("index");
        Route::get("/{id}/detail", [ExternalLinkTypeController::class, 'show'])->name("show");
        Route::get("/create", [ExternalLinkTypeController::class, 'create'])->name("create");
        Route::post("/store", [ExternalLinkTypeController::class, 'store'])->name("store");
        Route::get("/{id}/edit", [ExternalLinkTypeController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [ExternalLinkTypeController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [ExternalLinkTypeController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "external-links",
        "as" => "external-links.",
    ], function () {
        Route::get("/", [ExternalLinkController::class, 'index'])->name("index");
        Route::get("/{id}/detail", [ExternalLinkController::class, 'show'])->name("show");
        Route::get("/create", [ExternalLinkController::class, 'create'])->name("create");
        Route::post("/store", [ExternalLinkController::class, 'store'])->name("store");
        Route::get("/{id}/edit", [ExternalLinkController::class, 'edit'])->name("edit");
        Route::post("/{id}/update", [ExternalLinkController::class, 'update'])->name("update");
        Route::post("/{id}/delete", [ExternalLinkController::class, 'delete'])->name("delete");
    });

    Route::group([
        "prefix" => "subscription-rules",
        "as" => "subscription-rules.",
    ], function () {
        Route::get("/", [SubscriptionRuleController::class, 'index'])->name("index");
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa');
});

Auth::routes();

Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');
