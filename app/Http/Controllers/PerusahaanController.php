<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }
}
