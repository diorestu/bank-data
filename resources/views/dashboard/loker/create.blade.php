@extends('layouts.company')

@section('css')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 150px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endsection

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Data Lowongan
                    </div>
                    <h2 class="page-title">
                        Tambah Lowongan Kerja
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <form class="card" id="addLeadForm" method="POST" action="{{ route('kandidat.store') }}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Kategori Pekerjaan<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <select class="" id="category" name="category" id="category">
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Judul Lowongan<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <input type="text" class="form-control @error('job_title') is-invalid @enderror"
                                placeholder="16 digit" name="job_title" value="{{ old('job_title') }}" id="job_title"
                                required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Deskripsi Pekerjaan<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <textarea rows="5" class="form-control @error('job_description') is-invalid @enderror" name="job_description"
                                id="job_description" required>{{ old('job_description') }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Persyaratan Pekerjaan<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <textarea rows="5" class="form-control @error('job_requirement') is-invalid @enderror" name="job_requirement"
                                id="job_requirement" required>{{ old('job_requirement') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Bahasa<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <select class="" id="bahasa" name="bahasa[]">
                                <option value="{{ $item->id }}">Bahasa</option>
                                <option value="{{ $item->id }}">English</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Lokasi Bekerja</label>
                        <div class="col">
                            <select class="" id="bahasa" name="bahasa[]">
                                <option value="{{ $item->id }}">Remote (WarmableInterface)</option>
                                <option value="{{ $item->id }}">On Site (WFA)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-3 col-form-label required">Status Pekerjaan<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <select class="" id="bahasa" name="bahasa[]">
                                <option value="{{ $item->id }}">Full-time</option>
                                <option value="{{ $item->id }}">Part-time</option>
                                <option value="{{ $item->id }}">Kontrak</option>
                                <option value="{{ $item->id }}">Internship</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-pill btn-primary w-100" id="btnSubmit">
                        <i class="bx bx-spin bx-loader-alt me-2 d-none" id="spinner"></i>
                        Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#job_description'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#job_requirement'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        var settings = {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        };
        new TomSelect('#category', settings);
        new TomSelect('#bahasa', settings);
    </script>
@endsection
