@extends('layouts.app')


@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Kantor Mitra') }}
            </h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-teal   " data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bx bx-plus me-1"></i>Tambah Perusahaan Mitra
            </button>

            <!-- Modal -->
            <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Perusahaan Mitra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('mitra.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Mitra</label>
                                    <input type="text" class="form-control" name="lokasi" placeholder="Nama Mitra">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Mitra</label>
                                    <textarea type="text" class="form-control" name="alamat"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No. Telepon Mitra</label>
                                    <input type="tel" class="form-control" name="phone"
                                        placeholder="No. Telepon Mitra">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    Submit Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card table-responsive">
                <table class="table table-nowrap table-vcenter" id="dataTable" width="100%" cellspacing=0>
                    <thead class="">
                        <tr>
                            <th class="ps-4">{{ __('Nama Kantor') }}</th>
                            <th class="ps-4">{{ __('Alamat') }}</th>
                            <th class="text-center">{{ __('Menu') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            var table = $('#dataTable').DataTable({
                "dom": '<"d-flex justify-content-between align-items-center m-3"f><"my-2"t><"d-flex justify-content-between align-items-center mx-3 mb-2"lp>',
                "oLanguage": {
                    "sSearch": "Cari:"
                },
                "language": {
                    "emptyTable": "Data Tidak Tersedia",
                    "paginate": {
                        "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="11 7 6 12 11 17"></polyline><polyline points="17 7 12 12 17 17"></polyline></svg>',
                        "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="7 7 12 12 7 17"></polyline><polyline points="13 7 18 12 13 17"></polyline></svg>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('mitra.index') }}",
                columns: [{
                        data: 'lokasi',
                        name: 'lokasi',
                        searchable: true,
                        class: 'ps-4'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                        searchable: true,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10%',
                        class: 'text-center'
                    },
                ]
            });
        });
    </script>
@endsection
