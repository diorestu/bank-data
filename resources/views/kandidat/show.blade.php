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
                <button type="button"
                    class="btn btn-orange {{ $data->status == 'interviewed' || $data->status == 'approved' || $data->status == 'rejected' ? 'd-none' : '' }}"
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
                <button type="button"
                    class="btn btn-teal ms-2 {{ $data->status == 'approved' || $data->status == 'appointment' || $data->status == 'rejected' ? 'd-none' : '' }}"
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
                <a class="btn btn-indigo ms-2" href="{{ route('kandidat.edit', $data->id) }}">
                    <i class="bx bxs-pen me-1"></i>Edit
                </a>
                <form action="{{ route('kandidat.destroy', $data->id) }}" method="post" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-2">
                        <i class="bx bxs-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <span class="avatar me-3 rounded"
                                    style="background-image: url(https://eu.ui-avatars.com/api/?background=0D8ABC&color=fff&length=3&name={{ urlencode($data->nama) }})">
                                </span>
                                <div>
                                    <div>{{ $data->nama }}</div>
                                    <span class="text-muted">{{ repPhoneNum($data->telp) }}</span>
                                </div>
                            </div>
                            <div class="card card-sm mb-2">
                                @if (!$data->pas_foto)
                                    <a href="{{ asset('assets/img/no-image.png') }}" class="card-body d-block swipebox"
                                        title="Pas Foto Kandidat">
                                        <label class="form-label">Pas Foto</label>
                                        <img src="{{ asset('assets/img/no-image.png') }}" height="50%" width="50%">
                                    </a>
                                @elseif(substr($data->pas_foto, -3) == 'pdf')
                                    <a href="{{ asset('storage/' . stripslashes($data->pas_foto)) }}"
                                        class="card-body d-flex justify-content-between align-items-center text-decoration-none">
                                        <label class="form-label">Pas Foto<span class="ms-3 text-info"><i
                                                    class="bx bx-download me-1"></i>Unduh</span></label>
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . stripslashes($data->pas_foto)) }}"
                                        class="card-body d-block swipebox" title="Pas Foto Kandidat">
                                        <label class="form-label">Pas Foto</label>
                                        <img src="{{ asset('storage/' . stripslashes($data->pas_foto)) }}" height="50%"
                                            width="50%">
                                    </a>
                                @endif
                            </div>
                            <div class="card card-sm mb-2">
                                @if (!$data->ktp)
                                    <a href="{{ asset('assets/img/no-image.png') }}" class="card-body d-block swipebox"
                                        title="Foto Dokumen KTP">
                                        <label class="form-label">KTP</label>
                                        <img src="{{ asset('assets/img/no-image.png') }}" height="50%" width="50%">
                                    </a>
                                @elseif(substr($data->ktp, -3) == 'pdf')
                                    <a href="{{ asset('storage/' . stripslashes($data->ktp)) }}"
                                        class="card-body d-flex justify-content-between align-items-center text-decoration-none">
                                        <label class="form-label">KTP<span class="ms-3 text-info"><i
                                                    class="bx bx-download me-1"></i>Unduh</span></label>
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . stripslashes($data->ktp)) }}"
                                        class="card-body d-block swipebox" title="Foto Dokumen KTP">
                                        <label class="form-label">KTP</label>
                                        <img src="{{ asset('storage/' . stripslashes($data->ktp)) }}" height="50%"
                                            width="50%">
                                    </a>
                                @endif
                            </div>
                            <div class="card card-sm mb-2">
                                @if (!$data->cv)
                                    <a href="javascript:void(0);" class="card-body d-block">
                                        <label class="form-label">CV / Resume</label>
                                        <p>Tidak Ada File Tersedia</p>
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . stripslashes($data->cv)) }}"
                                        class="card-body d-flex justify-content-between align-items-center text-decoration-none">
                                        <label class="form-label">CV / Resume<span class="ms-3 text-info"><i
                                                    class="bx bx-download me-1"></i>Unduh</span></label>
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="card" id="addLeadForm">
                        <div class="card-header card-header-light d-flex justify-content-between align-items-center">
                            <a href="{{ route('kandidat.print', $data->id) }}" class="btn btn-primary btn-block"
                                id="btnPrint">
                                <i class="bx bx-spin bx-loader-alt me-2 d-none" id="spinner"></i>
                                Print</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-wrap table-vcenter">
                                <tbody>
                                    <tr>
                                        <th width="27%">Kategori Pelamar</th>
                                        <td width="3%">:</td>
                                        <td>
                                            <div class="text-muted"><small
                                                    class="badge bg-indigo-lt">{{ ucwords($data->category->title) }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="27%">NIK</th>
                                        <td width="3%">:</td>
                                        <td>{{ ucwords($data->nik) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Nama Lengkap</th>
                                        <td width="3%">:</td>
                                        <td>{{ ucwords($data->nama) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Tempat Tanggal Lahir</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Jenis Kelamin</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->gender }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Tinggi & Berat Badan</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->tinggi . ' cm, ' . $data->berat . ' kg' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <table class="table table-wrap table-vcenter">
                                <tbody>
                                    <tr>
                                        <th width="27%">Email</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Nomor Telepon</th>
                                        <td width="3%">:</td>
                                        <td>{{ repPhoneNum($data->telp) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Alamat Domisili</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->alamat_surat }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Alamat Saat Ini</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <table class="table table-wrap table-vcenter">
                                <tbody>
                                    <tr>
                                        <th width="27%">Status Kawin</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->kawin }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Status Pendidikan Terakhir</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->pendidikan }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Status Bekerja</th>
                                        <td width="3%">:</td>
                                        <td>{{ ucwords($data->pekerjaan) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="27%">Status</th>
                                        <td width="3%">:</td>
                                        <td>{{ $data->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
        var alamat = $('#alamat').val();
        var alamat2 = $('#alamat_surat').val();

        $('#checked').change(function() {
            if (this.checked) {
                $('#alamat').attr('disabled', 'disabled');
                $('#alamat').val(alamat2);
            } else {
                $('#alamat').removeAttr('disabled');
                $('#alamat').val(alamat);
            }
        });
    </script>
    <script>
        var settings = {
            ocreate: true,
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
@endsection
