<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\RepairController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\ServiceHisotryController;
use App\Http\Controllers\Api\DashboardController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(["prefix" => "/auth", "as" => "auth."], function ($request) {
    $request
        ->post("register", [AuthController::class, "register"])
        ->name("register");

    $request
        ->post("login", [AuthController::class, "login"])
        ->name("login");
});

Route::group(["prefix" => "/cart", "as" => "c.", "middleware" => 'auth:sanctum'], function ($request) {
    $request
        ->get("all", [CartController::class, "getAll"])
        ->name("all");
    $request
        ->get("detail/{id}", [CartController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [CartController::class, "edit"])
        ->name("detial");
    $request
        ->post("", [CartController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [CartController::class, "delete"])
        ->name("delete");
});


Route::group(["prefix" => "/customer", "as" => "cus.", "middleware" => 'auth:sanctum'], function ($request) {
    $request
        ->get("all", [CustomerController::class, "getAll"])
        ->name("all");
    $request
        ->get("detail/{id}", [CustomerController::class, "getDetail"])
        ->name("detial");
    $request
        ->post("filter", [CustomerController::class, "getAllFilter"])
        ->name("filter");
    $request
        ->put("{id}", [CustomerController::class, "edit"])
        ->name("edit");
    $request
        ->post("", [CustomerController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [CustomerController::class, "delete"])
        ->name("delete");
});

Route::group(["prefix" => "/phone", "as" => "phone.", "middleware" => 'auth:sanctum'], function ($request) {
    $request
        ->get("all", [PhoneController::class, "getAll"])
        ->name("all");
    $request
        ->get("detail/{id}", [PhoneController::class, "getDetail"])
        ->name("detial");
    $request
        ->post("filter", [PhoneController::class, "getAllFilter"])
        ->name("filter");
    $request
        ->put("{id}", [PhoneController::class, "edit"])
        ->name("detial");
    $request
        ->post("", [PhoneController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [PhoneController::class, "delete"])
        ->name("delete");
});

Route::group(["prefix" => "/repair", "as" => "repair.", "middleware" => 'auth:sanctum'], function ($request) {
    $request
        ->get("all", [RepairController::class, "getAll"])
        ->name("all");
    $request
        ->post("filter", [RepairController::class, "getAllFilter"])
        ->name("filter");
    $request
        ->get("detail/{id}", [RepairController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [RepairController::class, "edit"])
        ->name("detial");
    $request
        ->post("", [RepairController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [RepairController::class, "delete"])
        ->name("delete");
});

Route::group(["prefix" => "/sale", "as" => "sale.", "middleware" => 'auth:sanctum'], function ($request) {
    $request
        ->get("all", [SaleController::class, "getAll"])
        ->name("all");
    $request
        ->get("detail/{id}", [SaleController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [SaleController::class, "edit"])
        ->name("detial");
    $request
        ->post("", [SaleController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [SaleController::class, "delete"])
        ->name("delete");
});

Route::group(["prefix" => "/servicehistory", "as" => "servicehistory.", "middleware" => 'auth:sanctum'], function ($request) {
    $request
        ->get("all", [ServiceHisotryController::class, "getAll"])
        ->name("all");
    $request
        ->get("detail/{id}", [ServiceHisotryController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [ServiceHisotryController::class, "edit"])
        ->name("detial");
    $request
        ->post("", [ServiceHisotryController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [ServiceHisotryController::class, "delete"])
        ->name("delete");
});

Route::get("dashboard",[DashboardController::class, "index"])->middleware('auth:sanctum');