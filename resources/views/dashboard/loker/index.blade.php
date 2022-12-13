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
                        Lowongan Saya
                    </div>
                    <h2 class="page-title">
                        Data Lowongan
                    </h2>
                </div>
                @if (Auth::user()->roles[0]->name == 'company' || Auth::user()->roles[0]->name == 'admin')
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('lowongan.create') }}"
                                class="btn btn-pill btn-primary d-none d-sm-inline-block">
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
            <div class="table-responsive">
                <table class="table table-vcenter bg-white" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Judul Lowongan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th width="15%">Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->job_title }}</td>
                                <td>{{ ucwords($item->job_lokasi) }}</td>
                                <td>{{ $item->job_kontrak }}</td>
                                <td>{{ tglIndoFull($item->created_at) }}</td>
                                <td width="15%">
                                    <div class="d-flex gap-3 align-items-center">
                                        <a href="{{ route('lowongan.show', $item->id) }}" class="text-muted"><i
                                                class="bx bx-fw bxs-info-square"></i></a>
                                        <a class="text-success"><i class="bx bx-fw bxs-check-square"></i></a>
                                        <a class="text-danger"><i class="bx bx-fw bxs-x-square"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: '<"py-3 d-flex justify-content-between align-items-center"fl>t<"pt-2 d-flex justify-content-between align-items-center"ip><"clear">',
                "oLanguage": {
                    "sSearch": "Cari data:",
                },
                "language": {
                    "emptyTable": "Tidak Ada Data Tersedia",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": "<i class='bx bx-chevron-left'></i>",
                        "last": "<i class='bx bx-chevron-right'></i>",
                        "next": "<i class='bx bx-chevrons-right'></i>",
                        "previous": "<i class='bx bx-chevrons-left'></i>"
                    },
                }
            });
        });
    </script>
@endsection
