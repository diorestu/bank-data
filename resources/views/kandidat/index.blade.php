@extends('layouts.app')


@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Kandidat Pelamar') }}
            </h2>
            <a href="{{ route('kandidat.create') }}" class="btn btn-teal">
                <i class="bx bx-plus me-2"></i>Tambah Kandidat
            </a>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card table-responsive">
                {{-- <div class="d-flex flex-column p-3">
                    <label><i class="bx bxs-filter"></i> Status Kandidat</label>
                    <div id="search1" class="me-2" style="width: 300px !important;"></div>
                </div> --}}
                <table class="table table-vcenter" id="dataTable" width="100%" cellspacing=0>
                    <thead class="">
                        <tr>
                            <th class="ps-4">{{ __('Nama') }}</th>
                            <th class="text-center">{{ __('Detail') }}</th>
                            <th class="text-center">{{ __('Kontak Kandidat') }}</th>
                            <th class="text-center">{{ __('AGAMA') }}</th>
                            <th class="text-center">{{ __('TINGGI (cm)') }}</th>
                            <th class="text-center">{{ __('BERAT (kg)') }}</th>
                            <th class="text-center">{{ __('Status Kawin') }}</th>
                            <th class="text-center">{{ __('STATUS BEKERJA') }}</th>
                            <th class="text-center">{{ __('Pendidikan') }}</th>
                            <th class="text-center">{{ __('Status Kandidat') }}</th>
                            <th class="text-center">{{ __('hidden_status') }}</th>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#dataTable').DataTable({
                // "drawCallback": function(settings) {
                //     var counter = 0;
                //     this.api().columns([10]).every(function() {
                //         var column = this;
                //         counter++;
                //         var select = $(
                //                 '<select class="form-control form-select" id="search1"><option value=""></option></select>'
                //             )
                //             .appendTo($('#search' + counter))
                //             .on('change', function() {
                //                 var val = $.fn.dataTable.util.escapeRegex(
                //                     $(this).val()
                //                 );

                //                 column
                //                     .search(val ? '^' + val + '$' : '', true, false)
                //                     .draw();
                //             });

                //         column.data().unique().sort().each(function(d, j) {
                //             select.append('<option value="' +
                //                 d + '">' + d +
                //                 '</option>');
                //         });
                //     });
                // },
                "lengthMenu": [20, 50, 75, 100],
                "dom": '<"d-flex justify-content-between align-items-center m-3"lf><"my-2"t><"d-flex justify-content-center align-items-center mx-3 mb-2"p>',
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
                ajax: "{{ route('kandidat.index') }}",
                columns: [{
                        data: 'detail_nama',
                        name: 'detail_nama',
                        class: 'ps-3'
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        visible: false,
                        searchable: true,
                    },
                    {
                        data: 'sm_alamat',
                        name: 'sm_alamat',
                        searchable: true,
                        width: '20%'
                    },
                    {
                        data: 'agama',
                        name: 'agama',
                        searchable: false,
                        class: 'text-capitalize'
                    },
                    {
                        data: 'tinggi',
                        name: 'tinggi',
                        searchable: false,
                    },
                    {
                        data: 'berat',
                        name: 'berat',
                        searchable: false,
                    },
                    {
                        data: 'kawin',
                        name: 'kawin',
                        searchable: false,
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan',
                        searchable: false,
                        class: 'text-capitalize'
                    },
                    {
                        data: 'pendidikan',
                        name: 'pendidikan',
                        searchable: true,
                    },
                    {
                        data: 'stats',
                        name: 'stats',
                        searchable: true,
                        class: 'fw-bold text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: true,
                        visible: false,
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
