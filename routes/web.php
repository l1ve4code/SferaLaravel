<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\PositionController;
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

Auth::routes();

Route::get('/', [CardController::class, "index"])->name("index");
Route::post("/", [CardController::class, "find"])->name("find");

Route::prefix("admin")->middleware(["auth", "isAdmin"])->group(function (){

    Route::get("/edit/{id}", [CardController::class, "edit"])->name("card_edit");

    Route::post("/skill/create/{id}", [SkillController::class, "store"])->name("skill_create");
    Route::get("/skill/delete/{id}", [SkillController::class, "destroy"])->name("skill_delete");

    Route::get("/position", [PositionController::class, "index"])->name("position");
    Route::post("/position/create", [PositionController::class, "store"])->name("create_position");
    Route::post("/position/update/{id}", [PositionController::class, "update"])->name("update_position");
    Route::get("/position/delete/{id}", [PositionController::class, "destroy"])->name("delete_position");

});

Route::get("/logout", [LoginController::class, "logout"])->middleware("auth");
