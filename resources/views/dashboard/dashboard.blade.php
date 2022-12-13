@extends('layouts.company')

@section('css')
    <style>
        .widget-text {
            font-size: 17px !important;
            font-weight: 700 !important;
        }

        .rounded-4 {
            border-radius: 12px !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Dasbor Saya
                    </div>
                    <h2 class="page-title">
                        Hai, {{ auth()->user()->name }}
                    </h2>
                </div>
                @if (Auth::user()->roles[0]->name == 'company' || Auth::user()->roles[0]->name == 'admin')
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-pill btn-primary d-none d-sm-inline-block">
                                <div class="d-flex justify-content-between align-items-center">
                                    <i class="bx bx-send me-2"></i>
                                    <span>Posting Lowongan Kerja</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck mb-5">
                @if (Auth::user()->roles[0]->name == 'company' || Auth::user()->roles[0]->name == 'admin')
                    <div class="col-sm-6 col-md-4">
                        <div class="card rounded-4 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <div class="avatar bg-teal rounded-circle fw-bold" style="font-size: 20px;">30</div>
                                    <div class="">
                                        <span class="mb-0 pb-0 antialiased text-muted widget-text" style="">Lowongan
                                            Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card rounded-4 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <div class="avatar bg-indigo rounded-circle fw-bold" style="font-size: 20px;">30</div>
                                    <div class="">
                                        <span class="mb-0 pb-0 antialiased text-muted widget-text" style="">Pelamar
                                            Aktif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card rounded-4 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <div class="avatar bg-orange rounded-circle fw-bold" style="font-size: 20px;">30</div>
                                    <div class="">
                                        <span class="mb-0 pb-0 antialiased text-muted widget-text" style="">Proses
                                            Seleksi
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-6 col-md-4">
                        <div class="card rounded-4 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <div class="avatar bg-orange rounded-circle fw-bold" style="font-size: 20px;">30</div>
                                    <div class="">
                                        <span class="mb-0 pb-0 antialiased text-muted widget-text" style="">Lamaran
                                            Kerja
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card rounded-4 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-start align-items-center gap-3">
                                    <div class="avatar bg-pink rounded-circle fw-bold" style="font-size: 20px;">3</div>
                                    <div class="">
                                        <span class="mb-0 pb-0 antialiased text-muted widget-text" style="">Proses
                                            Interview
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="card-body px-0">
                    @if (Auth::user()->roles[0]->name == 'company' || Auth::user()->roles[0]->name == 'admin')
                        <h3 class="mb-3 px-3">Daftar Pelamar Terbaru</h3>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-nowrap">
                                <thead class="">
                                    <th>No.</th>
                                    <th>Lowongan</th>
                                    <th>Nama</th>
                                    <th>Tanggal Apply</th>
                                    <th width="15%">Menu</th>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>Digital Editor</td>
                                    <td>Damas</td>
                                    <td>09 08 2022</td>
                                    <td width="15%">
                                        <div class="d-flex gap-3 align-items-center">
                                            <a class="text-muted"><i class="bx bx-fw bxs-info-square"></i></a>
                                            <a class="text-success"><i class="bx bx-fw bxs-check-square"></i></a>
                                            <a class="text-danger"><i class="bx bx-fw bxs-trash"></i></a>
                                        </div>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="mb-3 px-3">Riwayat Lamaran Kerja</h3>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-nowrap">
                                <thead class="">
                                    <th>No.</th>
                                    <th>Lowongan</th>
                                    <th>Tanggal Apply</th>
                                    <th>Status</th>
                                    <th width="15%">Menu</th>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>Digital Editor</td>
                                    <td>Profil Screening</td>
                                    <td>09 08 2022</td>
                                    <td width="15%">
                                        <div class="d-flex gap-3 align-items-center">
                                            <a class="text-muted"><i class="bx bx-fw bxs-info-square"></i></a>
                                            <a class="text-success"><i class="bx bx-fw bxs-check-square"></i></a>
                                            <a class="text-danger"><i class="bx bx-fw bxs-trash"></i></a>
                                        </div>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var settings = {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        };
        new TomSelect('#gender', settings);
        new TomSelect('#agama', settings);
        new TomSelect('#kawin', settings);
        new TomSelect('#pendidikan', settings);
        new TomSelect('#pekerjaan   ', settings);
    </script>
@endsection
