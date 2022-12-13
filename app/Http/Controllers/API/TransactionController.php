<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController;

class TransactionController extends BaseController
{
    public function get()
    {
        $data = ['name' => 'Damasius'];
        return response()->json($data, 200);
    }

    public function postMotor(Request $r)
    {
        try {
            $res = Transaksi::create([
                'id_user' => $r->id_user,
                'nominal' => 1000,
                'tipe'    => $r->tipe
            ]);
            return $this->sendResponse($res, 'Data Tiket Tersimpan!');
        } catch (\Throwable $th) {
            return $this->sendError('Gagal!.', ['error' => $th->getMessage()]);
        }
    }

    public function postMobil(Request $r)
    {
        try {
            $res = Transaksi::create([
                'id_user' => $r->id_user,
                'nominal' => 2000,
                'tipe'    => $r->tipe
            ]);
            return $this->sendResponse($res, 'Data Tiket Tersimpan!');
        } catch (\Throwable $th) {
            return $this->sendError('Gagal!.', ['error' => $th->getMessage()]);
        }
    }

    public function hitungTransaksi(Request $r)
    {
        $data = [];
        foreach (explode(' - ', $r->date) as $i) {
            array_push($data, $i);
        }
        $res = Transaksi::with('user')->whereBetween('created_at', [$data[0], $data[1]])->where('id_user', $r->id_user)->get();

        return response()->json($res);
    }

    public function hitungTransaksiLokasi(Request $r)
    {
        $data = [];
        foreach (explode(' - ', $r->date) as $i) {
            array_push($data, $i);
        }
        $res = Transaksi::with('user')->whereBetween('created_at', [$data[0], $data[1]])->where('id_user', $r->id_user)->get();

        return response()->json($res);
    }

    public function getDataTransaction(Request $request)
    {
        $id = $request->id_user;
        $databulan = DB::table('transaksis')->selectRaw('DATE_FORMAT(transaksis.created_at, "%m-%Y") bulan, count(nominal) as totalTransaksiBulanIni')
            ->groupBy('bulan')
            ->where('id_user', $id)
            ->get();

        $data = DB::table('transaksis')->selectRaw('DATE_FORMAT(transaksis.created_at, "%Y-%m-%d") tgl_param, DATE_FORMAT(transaksis.created_at, "%m-%Y") bulan, DATE_FORMAT(transaksis.created_at, "%d-%m-%Y") tanggal, sum(nominal) AS totalPemasukan, count(nominal) as totalTiketHariIni')
            ->groupBy('tanggal')
            ->where('id_user', $id)
            ->get();

        try {
            foreach ($databulan as $value) {
                $value->data = collect([]);
                foreach ($data as $item) {
                    if ($value->bulan == $item->bulan) {
                        $b             = substr($item->bulan, 0, 2);
                        $item->bulan   = Carbon::parse($item->tanggal)->locale('id')->isoFormat('MMMM');
                        $item->tanggal = Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, LL');
                        $value->data->push($item);
                    }
                }
                $b            = substr($value->bulan, 0, 2);
                $value->bulan = Carbon::createFromFormat('m', $b)->locale('id')->isoFormat('MMMM');
            }
            return $this->sendResponse($databulan, 'Get Transaction Successfully');
        } catch (\Throwable $th) {
            return $this->sendError('Gagal!', ['error' => $th->getMessage()]);
        }
    }

    public function getTransactionDetail(Request $request, $date)
    {
        $id = $request->id_user;
        $data = DB::table('transaksis')->leftJoin('users', 'users.id', '=', 'transaksis.id_user')
            ->selectRaw("users.name,
            id_user as userId,
            transaksis.created_at as tgl,
            sum(nominal) as totalPendapatanHariIni,
            count(nominal) as totalHariIni,
            (select count(nominal) from transaksis where tipe='mobil' AND DATE(tgl)=DATE(transaksis.created_at) AND userId=id_user) countMobil,
            (select count(nominal) from transaksis where tipe='motor' AND DATE(tgl)=DATE(transaksis.created_at) AND userId=id_user) countMotor,
            (select count(nominal) from transaksis where tipe='mobil-qris' AND DATE(tgl)=DATE(transaksis.created_at) AND userId=id_user) countMobilQris,
            (select count(nominal) from transaksis where tipe='motor-qris' AND DATE(tgl)=DATE(transaksis.created_at) AND userId=id_user) countMotorQris,
            (select sum(nominal) from transaksis where tipe='mobil' AND DATE(tgl)=DATE(created_at)) totalMobil,
            (select sum(nominal) from transaksis where tipe='motor' AND DATE(tgl)=DATE(created_at)) totalMotor,
            (select sum(nominal) from transaksis where tipe='mobil-qris' AND DATE(tgl)=DATE(created_at)) totalMobilQris,
            (select sum(nominal) from transaksis where tipe='motor-qris' AND DATE(tgl)=DATE(created_at)) totalMotorQris")
            ->where('transaksis.id_user', $id)
            ->whereDate('transaksis.created_at', $date)->first();

        try {
            $data->tanggal = Carbon::parse($data->tgl)->isoFormat('dddd, LL');
            return $this->sendResponse($data, 'Get Transaction Successfully');
        } catch (\Throwable $th) {
            return $this->sendError('Gagal!', ['error' => $th->getMessage()]);
        }
    }
}
