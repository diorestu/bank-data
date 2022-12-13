@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Kategori') }}
            </h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-teal" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bx bx-plus me-1"></i>Tambah Kategori
            </button>

            <!-- Modal -->
            <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('kategori.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Judul Kategori</label>
                                    <input type="text" class="form-control" name="title" placeholder="Judul Kategori">
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
            <div class="row row-deck">
                <div class="col-12 col-md-5">
                    <div class="card table-responsive">
                        <table class="table table-nowrap table-vcenter" id="dataTable" width="100%" cellspacing=0>
                            <thead class="">
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Kategori') }}</th>
                                    {{-- <th class="text-center">{{ __('Jumlah Kandidat') }}</th> --}}
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="card card-sm shadow-sm">
                        <div class="card-body">
                            <canvas id="genderChart" height="220px"></canvas>
                        </div>
                    </div>
                </div>
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
            ajax: "{{ route('kategori.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    class: 'text-center',
                    orderable: false,
                    searchable: false,
                    width: '5%'
                },
                {
                    data: 'title',
                    name: 'title',
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var label3 = {{ Js::from($data['labels']) }};
        var data3 = {{ Js::from($data['values']) }};

        const dataGender = {
            labels: label3,
            datasets: [{
                label: 'Jumlah Kandidat',
                backgroundColor: [
                    "#f72585",
                    "#b5179e",
                    "#7209b7",
                    "#560bad",
                    "#480ca8",
                    "#3a0ca3",
                    "#3f37c9",
                    "#4361ee",
                    "#4895ef",
                    "#4cc9f0", '#99d98c', "#76c893", "#52b69a", '#34a0a4', '#168aad'
                ],
                borderColor: [
                    "#f72585",
                    "#b5179e",
                    "#7209b7",
                    "#560bad",
                    "#480ca8",
                    "#3a0ca3",
                    "#3f37c9",
                    "#4361ee",
                    "#4895ef",
                    "#4cc9f0", '#99d98c', "#76c893", "#52b69a", '#34a0a4', '#168aad'
                ],
                data: data3,
            }],
        };

        const genderChart = new Chart(
            document.getElementById('genderChart'), {
                type: 'bar',
                data: dataGender,
                weight: 1,
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kandidat per Kategori'
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                display: false
                            }
                        }
                    }
                },
            }
        );
    </script>
@endsection
