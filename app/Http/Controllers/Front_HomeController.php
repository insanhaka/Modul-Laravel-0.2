<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Front_HomeController extends Controller
{
    public function index()
    {
        return view('Frontend.Home.index');
    }
}
