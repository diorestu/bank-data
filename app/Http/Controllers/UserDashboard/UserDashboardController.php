<?php

namespace App\Http\Controllers\UserDashboard;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $applied = JobApplication::where('id_user', Auth::user()->id)->get();
        return view('dashboard.dashboard', [
            'applied' => $applied
        ]);
    }

    public function indexResume()
    {
        return view('dashboard.resume.index');
    }

    public function createResume()
    {
        return view('dashboard.resume.create');
    }

    public function lamaranSaya()
    {
        return view('dashboard.loker.index_user');
    }
}
