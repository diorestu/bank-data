@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Edit Data Petugas') }}
            </h2>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('petugas.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                                            value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pengguna</label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Nama Pengguna" value="{{ $data->username }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <div class="mb-2">
                                        <div class="form-label">Status</div>
                                        <select class="form-select" name="roles">
                                            <option value="admin" {{ $data->roles == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="staff" {{ $data->roles == 'staff' ? 'selected' : '' }}>Juru
                                                Parkir</option>
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
                                                <option value="{{ $i->id }}"
                                                    {{ $i->id == $data->id_lokasi ? 'selected' : '' }}>
                                                    {{ $i->lokasi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. HP Petugas</label>
                                        <input class="form-control" name="phone" type="text" value="{{ $data->phone}}"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Petugas</label>
                                        <input class="form-control" name="images" type="file" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-link link-secondary">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-orange ms-auto">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
