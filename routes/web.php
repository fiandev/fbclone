<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\authController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\friendsController;
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

Route::resource('/', homeController::class)->middleware("auth");
Route::resource('/home', homeController::class)->middleware("auth");

/* ===== logging routes =====*/
Route::get("/login/", [authController::class, "login"])->name("login")->middleware("guest");
Route::resource("/register/", authController::class)->except("show")->middleware("guest");

Route::post("/login/", [authController::class, "authenticate"])->middleware("guest");
Route::post("/logout/", [authController::class, "logout"])->middleware("auth");

/* ===== posts routes ===== */
Route::get("/posts/{post:slug}", [PostController::class, "show"])->middleware("auth");
Route::post("/posts/{post:slug}", [PostController::class, "response"])->middleware("auth");

/* ===== comments routes ===== */
Route::put("/comments/{post:slug}", [commentController::class, "store"])->middleware("auth");
Route::get("/comments/{post:slug}", [commentController::class, "index"])->middleware("auth");


/* ===== friendlist routes ===== */
Route::resource("/friends/", friendsController::class)->middleware("auth");

/* ===== media routes ===== */
Route::get('/static-files/{post:media}', function($filename){
    $path = storage_path('app/' . "static-files/" . $filename);
    
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->middleware("auth");

/* ===== users routes ===== */
Route::get("/profile/{user:uid}", [profileController::class, "index"])->middleware("auth");