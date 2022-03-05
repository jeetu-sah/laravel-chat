<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
    * Show the application main page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index() {
        return view('users');
    }
}
