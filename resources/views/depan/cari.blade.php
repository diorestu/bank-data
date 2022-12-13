@extends('layouts.guest')

@section('content')
    <div class="container px-2 px-lg-5 pt-3">
        <div class="card-body px-2 px-lg-5">
            <form class="row row-cards align-items-end" id="formCari" method="post">
                @method('POST')
                @csrf
                <div class="mb-2 col-sm-8 col-md-7">
                    <label class="form-label required">Kata Kunci</label>
                    <input name="search" type="text" class="form-control shadow shadow-sm border-primary"
                        placeholder="Ketik kata kunci pekerjaan, jabatan, lokasi, dll" required>
                </div>
                <div class="mb-2 col-sm-4 col-md-3">
                    <label class="form-label">Lokasi Kerja</label>
                    <select class="form-select" name="lokasi">
                        <option value="All">Semua Lokasi</option>
                        <option value="Bali">Bali</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                    </select>
                </div>
                <div class="mb-2 col-sm-12 col-md-2">
                    <label class="form-label"></label>
                    <button type="submit" class="btn btn-primary w-100"><i class="bx bx-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
        <div class="">
            <div class="" id="message">
            </div>
            <div id="data-wrapper">
                <!-- Results -->
            </div>
            <div class="text-center my-3 auto-load" id="loader">
                <div class='text-center mt-4'><span class='text-reset fw-bold'><i
                            class="bx bx-loader-alt bx-spin me-2"></i>Memuat</span></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.auto-load').hide();
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#formCari").submit(function(e) {
            e.preventDefault();
            $('#data-wrapper').html("");
            $('.auto-load').show();
            var lokasi = $("select[name=lokasi]").val();
            var search = $("input[name=search]").val();

            $.ajax({
                type: 'POST',
                url: "{!! route('app.postCari') !!}",
                data: {
                    search: search,
                    lokasi: lokasi,
                },
                success: function(data) {
                    console.log(data.data);
                    if (data.data.length == 0 || !data.data) {
                        setTimeout(() => {
                            $('.auto-load').show();
                        }, 3000);
                        $('.auto-load').html(
                            "<div class='text-center mt-4'><span class='text-reset fw-bold'>Tidak Ada Data Tersedia</span></div>"
                        );
                        $('#message').html(data.message);
                        return;
                    } else {
                        $('.auto-load').hide();
                        $('#message').addClass('hr-text');
                        $('#message').html(data.message);
                        for (var i = 0; i < data.data.length; i++) {
                            var row = $(
                                '<div class="card border-dark mb-3" id=""><div class="card-body"><div class="row align-items-center"><div class="col"><h2 class="mb-0 fw-bold"><a href="#" class="text-reset">' +
                                data.data[i].job_title +
                                '</a></h2><div class="text-muted">' +
                                data.data[i].job_kontrak +
                                ' - ' +
                                data.data[i].job_lokasi +
                                '</div><span class="status status-azure status-lite my-2"><span class="status-dot"></span>' +
                                new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                }).format(data.data[i].job_salary) +
                                ' per bulan</span><div><a href="/" class="mt-1 me-3 text-cyan text-decoration-none cursor-pointer"><i class="bx bx-paper-plane me-2"></i>Lamar Sekarang</a></div></div><div class="col-auto"><div class="dropdown"><a href="#" class="btn-action cursor-default text-decoration-none"data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a><div class="dropdown-menu dropdown-menu-end"><a href="#" class="dropdown-item"><i class="bx bx-heart me-2"></i>TambahFavorit</a><a href="#" class="dropdown-item">Lamar Sekarang</a><a href="#" class="dropdown-item">Lihat Detail</a><a href="#" class="dropdown-item text-danger">Laporkan</a></div></div></div></div></div></div>'
                            );

                            $('#data-wrapper').append(row);
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.auto-load').hide();
                    $('#data-wrapper').append(
                        "<div class='text-center mt-4'><span class='text-reset fw-bold'>Gagal Memuat Data</span></div>"
                    );
                }
            });
        });
    </script>
@endsection
