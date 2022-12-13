@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/swipebox/css/swipebox.css') }}">
@endsection

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Detail Kategori') }}
            </h2>
            <form action="{{ route('kategori.destroy', $data->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ms-auto">
                    Hapus Data
                </button>
            </form>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <form action="{{ route('kategori.update', $data->id) }}" method="post">
                    <div class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="title" placeholder="Nama Mitra"
                                value="{{ $data->title }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
