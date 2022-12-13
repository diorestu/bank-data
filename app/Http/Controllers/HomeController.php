<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Lead;
use App\Models\User;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $results = Job::with('category')->latest()->paginate(10);
        return view('depan.home');
    }

    public function viewCari()
    {
        return view('depan.cari');
    }

    public function sendCari(Request $request)
    {
        if ($request->ajax()) {
            if ($request->lokasi == 'All') {
                $result['data'] = Job::with('category')->where('job_title', 'LIKE', '%' . $request->search . '%')->get();
                return response()->json($result);
            } elseif ($request->lokasi != 'All') {
                $result['data'] = Job::with('category')->where('job_title', 'LIKE', '%' . $request->search . '%')->where('job_area', 'LIKE', '%' . $request->lokasi . '%')->get();
                return response()->json($result);
            } else {
                $result['data'] = [];
                $result['message'] = 'Menampilkan hasil pencarian "' . $request->search . '" sebanyak ' . $result['data']->count() . ' hasil';
                return response()->json($result);
            }
        }
        $result['message'] = 'Tidak Ada Data Tersedia';
        return response()->json($result);
    }

    public function l1()
    {
        return view('depan.layanan-kategori');
    }
    public function l2()
    {
        return view('depan.layanan-gaji');
    }
    public function l3()
    {
        return view('depan.layanan-perusahaan');
    }
}
