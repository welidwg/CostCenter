<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\CycleProdController;
use App\Http\Controllers\DemandeurActController;
use App\Http\Controllers\DemandeurController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get("/optimize", function () {
    Artisan::call("optimize");
    dd("optimized");
});

Route::post("/login", [UserController::class, "auth"]);
Route::get("/logout", [UserController::class, "logout"]);
Route::get("/login", function () {
    if (!Auth::check())
        return view("login");
    else return  redirect()->to('/home');
})->name("login");
Route::get('/', function () {
    if (!Auth::check())
        return redirect()->to('/login');
    else return  redirect()->to('/home');
});
Route::get('/home', function () {
    return view("home/home");
});
Route::get("/error", function () {
    return view("errors/403");
});

//Route::get("/accounts", [UserController::class, "accountCreator"]);
Route::get("/allUsers/{type}", [UserController::class, "allUsers"]);
Route::middleware(['auth'])->group(function () {

    Route::post("/compte", [CompteController::class, "compte"]);
    Route::get('/profile', function () {
        return  view("profile/index");
    })->name("profile");
    Route::post("/profile/{id}", [UserController::class, "changePassword"])->name("user.password");
    Route::middleware(['admin'])->group(function () {
        Route::resource("/cycle", CycleProdController::class);
        Route::resource("/departement", DepartementController::class);
        Route::resource("/site", SiteController::class);
        Route::resource("/fonction", FonctionController::class);
        Route::resource("/demandeur", DemandeurController::class);
        Route::resource("/demandeurAct", DemandeurActController::class);
        Route::resource("/article", ArticleController::class);
        Route::resource("/user", UserController::class);
        Route::get("/article/python", [ArticleController::class, "addData"]);
        Route::get("/demandeur/python", [DemandeurController::class, "addData"]);
    });
});
