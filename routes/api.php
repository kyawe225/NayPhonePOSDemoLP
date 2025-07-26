<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\RepairController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\ServiceHisotryController;
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

Route::group(["prefix" => "/cart", "as" => "c.","middleware"=>"auth:sanctum"], function ($request) {
    $request
        ->get("all", [CartController::class, "index"])
        ->name("all");
    $request
        ->get("detail/{id}", [CartController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [CartController::class, "update"])
        ->name("detial");
    $request
        ->post("", [CartController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [CartController::class, "delete"])
        ->name("delete");
    $request
        ->post("check", [CartController::class, "check"])
        ->name("delete");
});


Route::group(["prefix" => "/customer", "as" => "cus.","middleware"=>"auth:sanctum"], function ($request) {
    $request
        ->get("all", [CustomerController::class, "index"])
        ->name("all");
    $request
        ->get("detail/{id}", [CustomerController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [CustomerController::class, "update"])
        ->name("detial");
    $request
        ->post("", [CustomerController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [CustomerController::class, "delete"])
        ->name("delete");
    $request
        ->post("check", [CustomerController::class, "check"])
        ->name("delete");
});

Route::group(["prefix" => "/phone", "as" => "phone.","middleware"=>"auth:sanctum"], function ($request) {
    $request
        ->get("all", [PhoneController::class, "index"])
        ->name("all");
    $request
        ->get("detail/{id}", [PhoneController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [PhoneController::class, "update"])
        ->name("detial");
    $request
        ->post("", [PhoneController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [PhoneController::class, "delete"])
        ->name("delete");
    $request
        ->post("check", [PhoneController::class, "check"])
        ->name("delete");
});

Route::group(["prefix" => "/repair", "as" => "repair.","middleware"=>"auth:sanctum"], function ($request) {
    $request
        ->get("all", [RepairController::class, "index"])
        ->name("all");
    $request
        ->get("detail/{id}", [RepairController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [RepairController::class, "update"])
        ->name("detial");
    $request
        ->post("", [RepairController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [RepairController::class, "delete"])
        ->name("delete");
    $request
        ->post("check", [RepairController::class, "check"])
        ->name("delete");
});

Route::group(["prefix" => "/sale", "as" => "sale.","middleware"=>"auth:sanctum"], function ($request) {
    $request
        ->get("all", [SaleController::class, "index"])
        ->name("all");
    $request
        ->get("detail/{id}", [SaleController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [SaleController::class, "update"])
        ->name("detial");
    $request
        ->post("", [SaleController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [SaleController::class, "delete"])
        ->name("delete");
    $request
        ->post("check", [SaleController::class, "check"])
        ->name("delete");
});

Route::group(["prefix" => "/servicehistory", "as" => "servicehistory.","middleware"=>"auth:sanctum"], function ($request) {
    $request
        ->get("all", [ServiceHisotryController::class, "index"])
        ->name("all");
    $request
        ->get("detail/{id}", [ServiceHisotryController::class, "getDetail"])
        ->name("detial");
    $request
        ->put("{id}", [ServiceHisotryController::class, "update"])
        ->name("detial");
    $request
        ->post("", [ServiceHisotryController::class, "insert"])
        ->name("create");
    $request
        ->delete("delete/{id}", [ServiceHisotryController::class, "delete"])
        ->name("delete");
    $request
        ->post("check", [ServiceHisotryController::class, "check"])
        ->name("delete");
});