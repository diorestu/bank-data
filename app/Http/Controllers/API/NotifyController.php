<?php

namespace App\Http\Controllers\API;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;

class NotifyController extends BaseController
{
    public function index(){
        try {
            $res = Pengumuman::latest()->take(5)->get();
            return $this->sendResponse($res, 'Get Notification Succesfully!');
        } catch (\Throwable $th) {
            return $this->sendError('Gagal!', ['error' => $th->getMessage()]);
        }
    }
    public function detail($id){
        try {
            $res = Pengumuman::findOrFail($id);
            return $this->sendResponse($res, 'Get Notifications Detail Succesfully');
        } catch (\Throwable $th) {
            return $this->sendError('Gagal!', ['error' => 'Data tidak dapat ditemukan!']);
        }
    }
}
