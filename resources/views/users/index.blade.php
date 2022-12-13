@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Petugas') }}
            </h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Data
            </button>

            <!-- Modal -->
            <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pengguna</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('petugas.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap">
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Nama Pengguna</label>
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Nama Pengguna">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Kata Sandi</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Kata Sandi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <div class="form-label">Status</div>
                                            <select class="form-select" name="roles">
                                                <option value="korlap">Korlap</option>
                                                <option value="staff">Juru Parkir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <div class="form-label">Lokasi Tugas</div>
                                            <select class="form-select" name="id_lokasi">
                                                @php
                                                    $lokasi = App\Models\Lokasi::get();
                                                @endphp
                                                @foreach ($lokasi as $i)
                                                    <option value="{{ $i->id }}">{{ $i->lokasi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    Simpan Data
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
                <table class="table table-nowrap" id="dataTable" width="100%" cellspacing=0>
                    <thead class="">
                        <tr>
                            <th>{{ __('No') }}</th>
                            <th >{{ __('Nama') }}</th>
                            <th >{{ __('User Name') }}</th>
                            <th >{{ __('No HP') }}</th>
                            <th >{{ __('Lokasi') }}</th>
                            <th class="text-center">{{ __('Roles') }}</th>
                            <th class="text-center">{{ __('Action') }}</th>
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
                "dom": '<"d-flex justify-content-start align-items-center m-3"f><"my-2"t><"d-flex justify-content-between align-items-center mx-3 mb-2"lp>',
                "oLanguage": {
                    "sSearch": "Cari:"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('petugas.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        width: '35%'
                    },
                    {
                        data: 'username',
                        name: 'username',
                        width: '12%'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        width: '12%'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi',
                        width: '15%'
                    },
                    {
                        class: "text-center",
                        data: 'status',
                        name: 'status',
                        width: '10%',
                        searchable: false,
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
        });
    </script>
@endsection
