<?php

namespace App\Http\Controllers;

use App\Charts\GenderChart;
use Illuminate\Http\Request;
use App\Charts\CategoryChart;

class DashboardController extends Controller
{
    public function index(GenderChart $chart)
    {
        return view('dashboard', [
            'chart'  => $chart->build(),
        ]);
    }
}
