<?php

require_once __DIR__ . "/../vendor/autoload.php";
use PRGANYRN\PROJECT\TEST\App\Route;
use PRGANYRN\PROJECT\TEST\Controller\HomeController;
use PRGANYRN\PROJECT\TEST\Controller\TestController;

Route::add("GET", "/", HomeController::class, "index", []);
Route::add("GET", "/errors/notfound", HomeController::class, "error", []);
Route::add("GET", "/test/url", TestController::class, "TestFunction", []);
Route::add("GET", "/test/url/([0-9a-zA-Z]*)/([0-9a-zA-Z]*)", TestController::class, "TestFunctionReg", []);

Route::gas();