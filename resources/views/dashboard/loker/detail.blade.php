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
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card mb-3">
                <div class="card-status-start bg-primary"></div>
                <div class="card-body">
                    <div class="mb-2">
                        <div class="page-pretitle">
                            {{ $data->company->company_title }}
                        </div>
                        <h2 class="page-title">
                            {{ $data->job_title }}
                        </h2>
                    </div>
                    <span class="status status-blue mb-2">
                        {{ $data['applicant']->count() }} orang sudah melamar
                    </span>
                    <p class="text-muted"></p>
                </div>
            </div>
            <h2 class="page-title mb-2">
                Data Pelamar
            </h2>
            <div class="table-responsive">
                <table class="table table-vcenter bg-white" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Tanggal Apply</th>
                            <th>Resume</th>
                            <th width="15%">Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['applicant'] as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item }}</td>
                                <td>25 Tahun</td>
                                <td>09 Desember 2022</td>
                                <td>
                                    <a href="#" class="btn btn-outline-teal btn-pill btn-sm"><i
                                            class="bx bxs-download me-2"></i>Lihat CV</a>
                                </td>
                                <td width="15%">
                                    <div class="d-flex gap-3 align-items-center">
                                        <a class="text-success"><i class="bx bx-fw bxs-check-square"></i></a>
                                        <a class="text-danger"><i class="bx bx-fw bxs-x-square"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- <tr>
                                <td colspan="6"></td>
                            </tr> --}}
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
