<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Front_DashboardController extends Controller
{
    public function index()
    {
        return view('Frontend.Dashboard.index');
    }
}
