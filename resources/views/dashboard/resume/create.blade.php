@extends('layouts.company')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta16/dist/css/tabler-payments.min.css">
@endsection
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Resume
                    </div>
                    <h2 class="page-title">
                        Buat Resume Saya
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <form class="card" id="addLeadForm" method="POST" action="{{ route('resume.store') }}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="hr-text mt-1 mb-2 mb-lg-3">
                        <span>DATA DIRI</span>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">NIK<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                placeholder="16 digit" name="nik" value="{{ old('nik') }}" id="nik" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Nama Lengkap<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Nama lengkap kandidat sesuai dengan KTP" name="nama"
                                value="{{ old('nama') }}" id="nama" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Deskripsi Singkat</label>
                        <div class="col">
                            <textarea rows="2" class="form-control" name="deskripsi" id="deskripsi" required>{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Agama<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <select class="rounded-3" id="agama" name="agama">
                                <option value="islam">Islam</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddha">Buddha</option>
                                <option value="kristen">Kristen</option>
                                <option value="katolik">Katolik</option>
                                <option value="konghucu">Konghucu</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Tempat & Tanggal Lahir<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col-6 col-md-5">
                            <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir"
                                id="tempat_lahir" value="{{ old('tempat_lahir') }}">
                        </div>
                        <div class="col-6 col-md-4 ">
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                value="{{ old('tgl_lahir') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Jenis Kelamin<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <select class="" id="gender" name="gender">
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Tinggi & Berat Badan</label>
                        <div class="col-6 col-md-5">
                            <div class="mb-1 input-group input-group-flat">
                                <input type="text" class="form-control text-end pe-2" value="{{ old('tinggi') }}"
                                    autocomplete="off" name="tinggi" id="tinggi">
                                <span class="input-group-text">
                                    cm
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="mb-1 input-group input-group-flat">
                                <input type="text" class="form-control text-end pe-2" value="{{ old('berat') }}"
                                    autocomplete="off" name="berat" id="berat">
                                <span class="input-group-text">
                                    kg
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Alamat Email</label>
                        <div class="col">
                            <input type="email" class="form-control" aria-describedby="emailHelp"
                                placeholder="Email Kandidat" name="email" id="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label class="col-sm-3 col-form-label required">Nomor Telepon<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <input type="text" class="form-control" aria-describedby="phoneHelp"
                                placeholder="Nomor Telepon Kandidat (diawali 62)" name="telp" id="telp"
                                value="{{ old('telp') }}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Alamat Sesuai KTP<span><sup
                                    class="text-danger">*</sup></span></label>
                        <div class="col">
                            <textarea rows="2" class="form-control" name="alamat_surat" id="alamat_surat" required>{{ old('alamat_surat') }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Alamat Saat Ini</label>
                        <div class="col">
                            <textarea rows="2" class="form-control" name="alamat" id="alamat" required>{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Status Kawin</label>
                        <div class="col">
                            <select class="" id="kawin" name="kawin" required>
                                <option value="Kawin">Kawin</option>
                                <option value="Belum Kawin">Belum Kawin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Pendidikan Terakhir</label>
                        <div class="col">
                            <select class="" id="pendidikan" name="pendidikan[]" required>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK/Sederajat</option>
                                <option value="D1/D2/Sederajat">D1/D2/Sederajat</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Nama Sekolah / Perguruan Tinggi</label>
                        <div class="col">
                            <input type="text" name="pendidikan[]" id="pendidikan2" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label required">Status Pekerjaan</label>
                        <div class="col">
                            <select class="" id="pekerjaan" name="pekerjaan" required>
                                <option value="aktif">Sudah Bekerja</option>
                                <option value="nonaktif">Belum Bekerja</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Pas Foto</label>
                        <input type="file" name="pas_foto" id="pas_foto" class="form-control" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Tema</label>
                        <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="form-payment" value="visa" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        <span class="payment payment-provider-visa payment-xs me-2"></span><strong>Creative
                                            Design</strong>
                                    </div>
                                </div>
                            </label>
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="form-payment" value="visa" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        <span class="payment payment-provider-paypal payment-xs me-2"></span><strong>ATS
                                            Design</strong>
                                    </div>
                                </div>
                            </label>
                            <label class="form-selectgroup-item flex-fill">
                                <input type="radio" name="form-payment" value="visa" class="form-selectgroup-input">
                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                    <div class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </div>
                                    <div>
                                        <span
                                            class="payment payment-provider-mastercard payment-xs me-2"></span><strong>Formal
                                            Design</strong>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" required>
                                <b class="form-check-label">
                                    Data ini sudah sesuai
                                </b>
                                <span class="form-check-description">
                                    Tanda <sup class="text-danger"></sup> pada nama kolom berarti wajib diisi. Pastikan
                                    data Anda sudah benar dan valid.
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-pill btn-success w-100" id="btnSubmit">
                        <i class="bx bx-spin bx-loader-alt me-2 d-none" id="spinner"></i>
                        Buat CV Saya</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var settings = {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        };
        new TomSelect('#gender', settings);
        new TomSelect('#agama', settings);
        new TomSelect('#kawin', settings);
        new TomSelect('#pendidikan', settings);
        new TomSelect('#pekerjaan   ', settings);
    </script>
@endsection
