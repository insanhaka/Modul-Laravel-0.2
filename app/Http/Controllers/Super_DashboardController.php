<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Super_DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('super-control');
    }

    public function dashboard()
    {
        return view('Super_Admin.Dashboard.index');
    }
}
