<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        td{
            font-size: 18px;
        }
    </style>
</head>

<body>
    <h2 style="margin-bottom: 0px !important; padding-bottom: 0px;"><b>REKAP HARIAN JURU PARKIR</b></h2>
    <h5 class="w3-margin-bottom" style="margin-top: 0px !important;">KAMIS, 22 SEPTEMBER 2022</h5>
    <table class="w3-table w3-bordered w3-border">
        <thead>
            <tr class="w3-blue">
                <th style="word-wrap: break-word;">Nama</th>
                <th style="word-wrap: break-word;">Lokasi</th>
                <th style="word-wrap: break-word;" width="10%">Total Tiket</th>
                <th style="word-wrap: break-word;" width="9%">Motor</th>
                <th style="word-wrap: break-word;" width="9%">Motor QRIS</th>
                <th style="word-wrap: break-word;" width="9%">Mobil</th>
                <th style="word-wrap: break-word;" width="9%">Mobil QRIS</th>
                <th style="word-wrap: break-word;" width="12%">Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($count as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ number_format($item->totalHariIni) }}</td>
                    <td>{{ $item->countMotor }} unit</td>
                    <td>{{ $item->countMobil }} unit</td>
                    <td>{{ $item->countMotorQris }} unit</td>
                    <td>{{ $item->countMobilQris }} unit</td>
                    <td>Rp {{ number_format($item->totalPendapatanHariIni) }}</td>
                </tr>
                @php
                    $total += (int)$item->totalPendapatanHariIni;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <tr>
                <td class="w3-right-align" colspan="7"><h4 style="margin-right: 20px;">TOTAL PENDAPATAN:</h4></td>
                <td class="w3-left-align" colspan="1"><h4 style="margin-right: 20px;"><b>Rp {{ number_format($total) }}</b></h4></td>
            </tr>
            </tr>
        </tfoot>
    </table>
</body>

</html>
