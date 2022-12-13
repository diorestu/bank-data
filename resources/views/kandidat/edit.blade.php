@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/swipebox/css/swipebox.css') }}">
@endsection

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none d-flex flex-row justify-content-between align-items-center">
            <h2 class="page-title text-white">
                {{ __('Detail Kandidat') }}
            </h2>
            <div class="d-flex align-items-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-orange me-2 {{ $data->status == 'interviewed' ? 'd-none' : '' }}"
                    data-bs-toggle="modal" data-bs-target="#interviewModal">
                    <i class="bx bxs-camera-home me-1"></i>Interview Kandidat
                </button>

                <!-- Modal -->
                <div class="modal fade" tabindex="-1" class="modal fade" id="interviewModal" tabindex="-1"
                    aria-labelledby="interviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Hasil Wawancara Kerja</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('kandidat.interview', $data->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $data->nama }}" disabled />
                                    </div>
                                    <div class="mb-0">
                                        <div class="form-label">Catatan Wawancara</div>
                                        <textarea name="notes" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                        Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-teal {{ $data->status == 'approved' ? 'd-none' : '' }}"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bx bxs-check-circle me-1"></i>Approve Kandidat
                </button>

                <!-- Modal -->
                <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pilih Penempatan Lokasi Kerja</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('kandidat.approve', $data->id) }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ $data->nama }}" disabled />
                                    </div>
                                    <div class="mb-0">
                                        <div class="form-label">Lokasi Kerja</div>
                                        <select class="form-select" name="location">
                                            @foreach (App\Models\Location::all() as $item)
                                                <option value="{{ $item->id }}">{{ strtoupper($item->lokasi) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                        Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <form action="{{ route('kandidat.destroy', $data->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-auto">
                        <i class="bx bxs-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="">
                <form class="card" id="addLeadForm" method="POST" action="{{ route('kandidat.update', $data->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="hr-text mt-1">
                            <span>DATA DIRI</span>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Kategori</label>
                            <div class="col">
                                <select class="" id="category_id" name="category_id"
                                    placeholder="Saat Ini: {{ ucwords($data->category->title) }}">
                                    <option selected value="{{ $data->category_id }}">Saat Ini:
                                        {{ ucwords($data->category->title) }}</option>
                                    @forelse ($cat as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @empty
                                        <option value="0">Tidak Ada Kategori</option>
                                    @endforelse
                                </select>
                                <small class="form-hint">Pilih Salah Satu Kategori Pekerjaan Kandidat</small>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">NIK</label>
                            <div class="col">
                                <input type="text" class="select form-control @error('nik') is-invalid @enderror"
                                    placeholder="16 digit" name="nik" value="{{ old('nik', $data->nik) }}"
                                    id="nik">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Nama Lengkap</label>
                            <div class="col">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="16 digit" name="nama" value="{{ old('nama', $data->nama) }}"
                                    id="nama">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Agama</label>
                            <div class="col">
                                <select class="form-control form-select" id="agama" name="agama">
                                    <option selected value="{{ $data->agama }}">Saat Ini:
                                        {{ ucwords($data->agama) }}
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
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Tempat & Tanggal Lahir</label>
                            <div class="col-5">
                                <input type="text" class="form-control" placeholder="Tempat Lahir"
                                    name="tempat_lahir" id="tempat_lahir"
                                    value="{{ old('tempat_lahir', $data->tempat_lahir) }}">
                            </div>
                            <div class="col-4">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                    value="{{ old('tgl_lahir', $data->tgl_lahir) }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Jenis Kelamin</label>
                            <div class="col">
                                <select class="form-control form-select" id="gender" name="gender" id="gender">
                                    <option selected value="{{ $data->gender }}">{{ $data->gender }}
                                    </option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Tinggi & Berat Badan</label>
                            <div class="col-5">
                                <div class="mb-1 input-group input-group-flat">
                                    <input type="text" class="form-control text-end pe-2"
                                        value="{{ old('tinggi', $data->tinggi) }}" autocomplete="off" name="tinggi"
                                        id="tinggi">
                                    <span class="input-group-text">
                                        cm
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-1 input-group input-group-flat">
                                    <input type="text" class="form-control text-end pe-2"
                                        value="{{ old('berat', $data->berat) }}" autocomplete="off" name="berat"
                                        id="berat">
                                    <span class="input-group-text">
                                        kg
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Alamat Email</label>
                            <div class="col">
                                <input type="email" class="form-control" aria-describedby="emailHelp"
                                    placeholder="Email Kandidat" name="email" id="email"
                                    value="{{ old('email', $data->email) }}">
                                <small class="form-hint">Mohon pastikan email Anda benar dan valid.</small>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label class="col-3 col-form-label required">Nomor Telepon</label>
                            <div class="col">
                                <input type="text" class="form-control" aria-describedby="phoneHelp"
                                    placeholder="Nomor Telepon Kandidat (diawali 62)" name="telp" id="telp"
                                    value="{{ old('telp', $data->telp) }}">
                                <small class="form-hint">Mohon untuk mengganti awalan nomor telepon 0 dengan 62
                                    (081 menjadi
                                    6281)</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Alamat Sesuai KTP</label>
                            <div class="col">
                                <textarea rows="2" class="form-control" name="alamat_surat" id="alamat_surat">{{ old('alamat_surat', $data->alamat_surat) }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Alamat Saat Ini</label>
                            <div class="col">
                                <textarea rows="2" class="form-control" name="alamat" id="alamat">{{ old('alamat', $data->alamat) }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required"></label>
                            <div class="col">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checked" onclick="checkBox()">
                                    <span class="form-check-label">
                                        Alamat Sesuai KTP
                                    </span>
                                    <span class="form-check-description">
                                        Centang apabila alamat saat ini sama dengan yang tertera pada Kartu Tanda
                                        Penduduk.
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Status Kawin</label>
                            <div class="col">
                                <select class="form-control form-select" id="kawin" name="kawin">
                                    <option selected value="{{ $data->kawin }}">Saat Ini:
                                        {{ ucwords($data->kawin) }}
                                    </option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Status Pendidikan</label>
                            <div class="col">
                                <select class="form-control form-select" id="pendidikan" name="pendidikan">
                                    <option selected value="{{ $data->pendidikan }}">Saat Ini:
                                        {{ ucwords($data->pendidikan) }}
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
                            <label class="col-3 col-form-label required">Status Pekerjaan</label>
                            <div class="col">
                                <select class="form-control form-select" id="pekerjaan" name="pekerjaan">
                                    <option selected value="{{ $data->pekerjaan }}">Saat Ini:
                                        {{ ucwords($data->pekerjaan) }}
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                    <option value="pensiun">Pensiun</option>
                                    <option value="mandiri">Mandiri</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="hr-text">
                        <span>DATA BERKAS ADMINISTRASI</span>
                    </div>
                    <div class="card-body">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-md-4">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">Pas Foto</label>
                                    <input type="file" name="pas_foto" id="pas_foto" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">KTP</label>
                                    <input type="file" name="ktp" id="ktp" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="mb-3 mb-0">
                                    <label class="form-label">CV / Resume</label>
                                    <input type="file" name="cv" id="cv" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                            <i class="bx bx-spin bx-loader-alt me-2 d-none" id="spinner"></i>
                            Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/swipebox/js/jquery.swipebox.js') }}"></script>
    <script type="text/javascript">
        ;
        (function($) {
            $('.swipebox').swipebox();
        })(jQuery);
    </script>
    <script>
        $(document).ready(function() {
            var alamat2 = $('#alamat_surat').val();
            var alamat = $('#alamat').val();
            $('#alamat').on('keyup', function() {
                alamat = $(this).val();
            });
            $('#alamat_surat').on('keyup', function() {
                alamat2 = $(this).val();
            });
            $('#checked').change(function() {
                // alert('dio');
                if (this.checked) {
                    $('#alamat').attr('disabled', 'disabled');
                    $('#alamat').val(alamat2);
                } else {
                    $('#alamat').removeAttr('disabled');
                    $('#alamat').val(alamat);
                }
            });
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
        new TomSelect('#category_id', settings);
        const choices = new Choices($('.form-select')[0]);
        const choices1 = new Choices($('.form-select')[1]);
        const choices2 = new Choices($('.form-select')[2]);
    </script>
    <script>
        $(document).ready(function() {
            $("#addLeadForm").validate({
                rules: {
                    nama: {
                        required: true,
                        maxlength: 120,
                    },
                    nik: {
                        required: true,
                        maxlength: 16,
                        digits: true
                    },
                    tinggi: {
                        digits: true
                    },
                    berat: {
                        digits: true
                    },
                    email: {
                        email: true
                    },
                    telp: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 16,
                    },
                },
                messages: {
                    nik: {
                        required: "Mohon input nomor identitas",
                        maxlength: "Input Nomor identitas maksimal adalah 16 angka",
                        digits: "Mohon input nomor identitas hanya berupa angka"
                    },
                    nama: {
                        required: "Mohon input nama Anda"
                    },
                    telp: {
                        required: "Mohon input nomor telepon",
                        digits: "Mohon input hanya berupa angka",
                        minlength: "Input Nomor telepon minimal adalah 10 digit",
                        maxlength: "Input Nomor telepon maksimal adalah 16 digit",
                    },
                    email: {
                        required: "Mohon input alamat email",
                        email: "Mohon input alamat email yang aktif dan valid",
                    },
                },

            });
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addLeadForm').ajaxForm({
            beforeSend: function() {
                $('#spinner').removeClass('d-none');
                $("#btnSubmit").attr("disabled", true);
                var percentage = '0';
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentage = percentComplete;
                $('.progress .progress-bar').css("width", percentage + '%', function() {
                    return $(this).attr("aria-valuenow", percentage) + "%";
                })
            },
            complete: function(xhr) {
                $('#spinner').addClass('d-none');
            },
            success: function(res) {
                $("#addLeadForm ")[0].reset();
                Swal.fire({
                    title: 'Berhasil',
                    text: res.success,
                    icon: 'success',
                    timer: 1500,
                });
                $("#btnSubmit").attr("disabled", false);
                $("#btnSubmit").removeClass("btn-primary");
                $("#btnSubmit").addClass("btn-success");
                window.location = "/kandidat";
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'Data Anda tidak valid, periksa kembali Form Anda!',
                    icon: 'error',
                    timer: 1500,
                });
                $("#btnSubmit").removeClass("btn-primary");
                $("#btnSubmit").addClass("btn-danger");
                $("#btnSubmit").attr("disabled", false);
            }
        });
    </script>
@endsection
