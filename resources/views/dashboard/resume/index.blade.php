@extends('layouts.company')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Resume
                    </div>
                    <h2 class="page-title">
                        Resume Saya
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('resume.create') }}" class="btn btn-pill btn-teal d-none d-sm-inline-block">
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="bx bx-plus-circle me-2"></i>
                                <span>Buat CV Saya</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck">
                @forelse ($resume as $item)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="avatar rounded-circle"></div>
                                    <h4>{{ $item->tipe_cv ?? 'ATS' }}</h4>
                                </div>
                                <a class="btn btn-outline-primary btn-pill btn-sm"><i
                                        class="bx bx-download me-2"></i>Unduh</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex justify-content-center pt-5">
                        <a class="btn btn-outline-primary btn-pill btn-sm"><i class="bx bx-download me-2"></i>Tidak Ada
                            File Tersedia</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
