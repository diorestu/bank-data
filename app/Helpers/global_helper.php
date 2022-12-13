<?php

use Carbon\Carbon;
use App\Libur;

function selisihJam($awal, $akhir)
{
    $a = Carbon::parse($awal);
    $b = Carbon::parse($akhir);
    $c = $b->diffInHours($a);
    return $c;
}

function hitungSelisihJam($awal, $akhir)
{
    $a = Carbon::parse($awal);
    $b = Carbon::parse($akhir);
    $c = $b->diffInHours($a, false);
    return $c;
}

function tglIndo($date)
{
    return Carbon::parse($date)->locale('id')->isoFormat('LL');
}

function tglIndoFull($date)
{
    return Carbon::parse($date)->locale('id')->isoFormat('dddd, LL');
}

function hariIndo($date)
{
    return Carbon::parse($date)->locale('id')->isoFormat('dddd');
}

function cekHariLibur()
{
    $libur = Libur::where('status', 'Aktif')->where('libur', date('Y-m-d'))->get();
    return count($libur) < 1 ? 0 : 1;
}

function getUmur($tgl)
{
    return Carbon::parse($tgl)->age . ' tahun';
}

function replaceString($string)
{
    return str_replace('"', '', $string);
}
function repPhoneNum($string)
{
    if (substr($string, 0, 1) == 0) {
        $output = ltrim($string, $string[0]);
        return '62' . $output;
    } elseif (substr($string, 0, 1) == 8) {
        return '62' . $string;
    }
    return $string;
}
