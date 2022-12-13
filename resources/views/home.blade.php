@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <h2 class="page-title text-white">
                {{ __('Dashboard') }}
            </h2>
            <h5 class="font-medium text-white">
                {{ __('Welcome') }} {{ auth()->user()->name ?? null }}
            </h5>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards mb-3">
                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar bg-purple">{{ $data['lead'] }}</span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">
                                        Kandidat
                                    </div>
                                    <div class="text-muted">
                                        {{ $data['lead_new'] }} kandidat baru
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar bg-azure">{{ $data['lead_n'] }}</span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">
                                        Kandidat Belum Bekerja
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar bg-info">{{ $data['cat'] }}</span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">
                                        Kategori
                                    </div>
                                    <div class="text-muted">
                                        {{ $data['cat_new'] }} kategori baru
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar bg-warning">{{ $data['loc'] }}</span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold">
                                        Lokasi
                                    </div>
                                    <div class="text-muted">
                                        {{ $data['loc_new'] }} lokasi baru
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-deck">
                <div class="col-md-12 col-lg-6 mb-3">
                    <div class="card card-sm shadow-sm">
                        <div class="card-body">
                            <canvas id="myChart" height="150px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="card card-sm shadow-sm">
                        <div class="card-body">
                            <canvas id="kawinChart" height="80px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3">
                    <div class="card card-sm shadow-sm">
                        <div class="card-body">
                            <canvas id="genderChart" height="80px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var labels = {{ Js::from($data['labels']) }};
        var users = {{ Js::from($data['values']) }};
        var label2 = {{ Js::from($data['k_label']) }};
        var data2 = {{ Js::from($data['k_value']) }};
        var label3 = {{ Js::from($data['g_label']) }};
        var data3 = {{ Js::from($data['g_value']) }};

        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kandidat Ditambahkan',
                backgroundColor: ['#99d98c', "#76c893", "#52b69a", '#34a0a4', '#168aad', '#1a759f', '#184e77',
                    '#354f52', '#2f3e46'
                ],
                borderColor: ['#99d98c', "#76c893", "#52b69a", '#34a0a4', '#168aad', '#1a759f', '#184e77',
                    '#354f52', '#2f3e46'
                ],
                data: users,
            }]
        };
        const dataKawin = {
            labels: label2,
            datasets: [{
                label: 'Status Kawin',
                backgroundColor: [
                    "#283d3b",
                    "#197278",
                ],
                borderColor: [
                    "#283d3b",
                    "#197278",
                ],
                borderWidth: [1, 1, 1, 1, 1],
                data: data2,
            }]
        };
        const dataGender = {
            labels: label3,
            datasets: [{
                label: 'Jenis Kelamin',
                backgroundColor: [
                    "#1572A1",
                    "#F675A8",
                ],
                borderColor: [
                    "#fff",
                ],
                borderWidth: [
                    3,
                ],
                data: data3,
            }]
        };

        const myChart = new Chart(
            document.getElementById('myChart'), {
                type: 'bar',
                data: data,
                weight: 3,
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kandidat Ditambahkan'
                        }
                    }
                }
            }
        );
        const kawinChart = new Chart(
            document.getElementById('kawinChart'), {
                type: 'doughnut',
                data: dataKawin,
                weight: 1,
            }
        );
        const genderChart = new Chart(
            document.getElementById('genderChart'), {
                type: 'doughnut',
                data: dataGender,
                weight: 1,
            }
        );
    </script>
@endsection
