@extends('layouts.guest')

@section('content')
    <div class="container px-2 px-lg-5 pt-3">
        <section class="section bg-default mb-3 p-3">
            <div class="container text-center">
                <h1 class="section-title fw-bold mb-2 hero-text">Bantu Raih Karir Impianmu Dengan Mudah</h1>
                <p class="section-description">
                    Persiapkan diri untuk menggapai karir impianmu dengan tepat dan mudah</p>
                <div class="mt-4">
                    <a href="/cari" class="btn btn-primary btn-pill">Cari Lowongan</a>
                    <a href="" class="btn btn-ghost-secondary ml-2">Bantuan</a>
                </div>
            </div>
        </section>
        <hr>
        <div class="d-none d-md-flex justify-content-center align-items-center mb-3">
            <h4 class="fw-bold text-primary me-3">Buat CV Kamu</h4>
            <h4 class="text-muted">-&nbsp;&nbsp;&nbsp;Hanya dengan beberapa langkah mudah</h4>
        </div>
        <div class="d-none d-md-flex justify-content-center align-items-center mb-3">
            <h4 class="fw-bold text-primary me-3">Untuk Perusahaan: Pasang Lowongan Kerja</h4>
            <h4 class="text-muted">-&nbsp;&nbsp;&nbsp;Rekrut karyawan baru dengan mudah disini</h4>
        </div>
        <div class="text-center mb-3">
            <h3 class="mb-3"><span class="text-primary">Upload CV</span> dan biarkan Perusahaan menemukanmu</h3>
            <a class="btn btn-outline-primary btn-pill">Upload CV Saya</a>
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
        new TomSelect('#lokasi', settings);

        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        loadMore(page);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() + 50 >= $(document).height()) {
                page++;
                loadMore(page);
            }
        });

        function loadMore(page) {
            $.ajax({
                    url: ENDPOINT + "/loker?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                    }
                })
                .done(function(response) {
                    if (response.length == 0) {
                        $('.auto-load').html(
                            "<div class='text-center mt-4'><span class='text-reset fw-bold'>Tidak Ada Data Tersedia</span></div>"
                        );
                        $('.auto-load').removeClass('card placeholder-glow border-dark');
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                    $('.auto-load').html("500 Internal Server Error:(");
                });
        }
    </script>
@endsection
