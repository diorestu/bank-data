@extends('layouts.company')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Riwayat
                    </div>
                    <h2 class="page-title">
                        Lamaran Kerja Saya
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="table-responsive border bg-white">
                <table class="table table-vcenter table-nowrap table-striped">
                    <thead>
                        <tr>
                            <th>Judul Lowongan</th>
                            <th>Nama Perusahaan</th>
                            <th>Lokasi Lowongan</th>
                            <th>Tanggal Apply</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Digital Marketing</td>
                            <td>PT Asta</td>
                            <td>Denpasar</td>
                            <td>22 November 2022</td>
                            <td>
                                <div class="status status-primary bg-teal">
                                    Screening
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
