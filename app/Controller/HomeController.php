<?php

namespace PRGANYRN\PROJECT\TEST\Controller;

use PRGANYRN\PROJECT\TEST\App\View;

class HomeController
{
    public function index()
    {
        View::view('Home/index', [
            "title" => "Homepage",
        ]);
    }

    public function error()
    {
        View::view('Error/404', [
            "title" => "not found"
        ]);
    }

}
