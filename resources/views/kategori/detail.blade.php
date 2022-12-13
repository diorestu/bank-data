@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Kategori') }} {{ $data }} <sup class="ms-3 text-orange">{{ $count }} kandidat</sup>
            </h2>
            <a href="{{ route('kategori.edit', $id) }}" class="btn btn-pill btn-indigo">Edit Kategori</a>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card table-responsive">
                <table class="table table-nowrap table-vcenter" id="dataTable" width="100%" cellspacing=0>
                    <thead class="">
                        <tr>
                            <th class="text-center">{{ __('No') }}</th>
                            <th class="text-center">{{ __('Nama') }}</th>
                            <th class="text-center">{{ __('Alamat') }}</th>
                            <th class="text-center">{{ __('Agama') }}</th>
                            <th class="text-center">{{ __('Detail') }}</th>
                            <th class="text-center">{{ __('Status Kawin') }}</th>
                            <th class="text-center">{{ __('Detail') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var table = $('#dataTable').DataTable({
            order: [
                [1, 'asc']
            ],
            "dom": '<"d-flex justify-content-start align-items-center m-3"f><"my-2"t><"d-flex justify-content-between align-items-center mx-3 mb-2"lp>',
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
            ajax: "{{ route('kategori.show', $id) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center',
                    orderable: false,
                    searchable: false,
                    width: '5%'
                },
                {
                    data: 'detail_nama',
                    name: 'detail_nama',
                },
                {
                    data: 'sm_alamat',
                    name: 'sm_alamat',
                },
                {
                    data: 'agama',
                    name: 'agama',
                    class: 'text-uppercase'
                },
                {
                    data: 'detail_badan',
                    name: 'detail_badan',
                },
                {
                    data: 'kawin',
                    name: 'kawin',
                },
                {
                    data: 'nama',
                    name: 'nama',
                    visible: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ]
        });
    </script>
@endsection
