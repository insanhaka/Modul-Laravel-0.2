<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Back_DashboardController extends Controller
{
    public function index()
    {
        return view('Backend.Dashboard.index');
    }
}
