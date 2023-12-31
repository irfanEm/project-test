<?php

require_once __DIR__ . "/../vendor/autoload.php";
use PRGANYRN\PROJECT\TEST\App\Route;
use PRGANYRN\PROJECT\TEST\Controller\GrupController;
use PRGANYRN\PROJECT\TEST\Controller\HomeController;
use PRGANYRN\PROJECT\TEST\Controller\TestController;
use PRGANYRN\PROJECT\TEST\Controller\UserController;
use PRGANYRN\PROJECT\TEST\Middleware\AuthMiddleware;
use PRGANYRN\PROJECT\TEST\Middleware\TamuMiddleware;

Route::add("GET", "/", HomeController::class, "index", [AuthMiddleware::class]);
Route::add("GET", "/edit", HomeController::class, "editView", [TamuMiddleware::class]);
Route::add("GET", "/errors/notfound", HomeController::class, "error", []);
Route::add("GET", "/test/url", TestController::class, "TestFunction", []);
Route::add("GET", "/test/url/([0-9a-zA-Z]*)/([0-9a-zA-Z]*)", TestController::class, "TestFunctionReg", []);
Route::add("GET", "/auth/daftar", UserController::class, "daftar", [TamuMiddleware::class]);
Route::add("POST", "/auth/daftar", UserController::class, "postDaftar", [TamuMiddleware::class]);
Route::add("GET", "/auth/login", UserController::class, "login", [TamuMiddleware::class]);
Route::add("POST", "/auth/login", UserController::class, "postLogin", [TamuMiddleware::class]);
Route::add("GET", "/auth/logout", UserController::class, "logout", [AuthMiddleware::class]);
Route::add("GET", "/user/perbarui", UserController::class, "perbaruiProfil", [AuthMiddleware::class]);
Route::add("POST", "/user/perbarui", UserController::class, "postPerbaruiProfil", [AuthMiddleware::class]);
Route::add("POST", "/user/postUbahSandi", UserController::class, "postUbahSandi", [AuthMiddleware::class]);
Route::add("GET", "/grup", GrupController::class, "index", [AuthMiddleware::class]);
Route::add("GET", "/grup/tambah", GrupController::class, "daftar", [AuthMiddleware::class]);
Route::add("POST", "/grup/tambah", GrupController::class, "postDaftar", [AuthMiddleware::class]);

Route::gas();