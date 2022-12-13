<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji</title>
    <style type="text/css">
        body {
            font-family: system-ui, sans-serif;
            font-size: 10px;
        }

        h2 {
            font-family: system-ui, sans-serif;

            font-size: 18px;
        }

        h3 {
            font-family: system-ui, sans-serif;
            font-size: 16px;

        }

        h4 {
            font-family: system-ui, sans-serif;
            font-size: 14px;
            margin: 1px;
        }

        h5 {
            font-family: system-ui, sans-serif;
            font-weight: 400;
            font-size: 13px;
            margin: 0px;
        }

        h6 {
            font-family: system-ui, sans-serif;
            font-size: 12px;
            margin: 0px;
        }

        p {
            font-family: system-ui, sans-serif;
            font-size: 10px;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        table,
        tr,
        td {
            vertical-align: bottom;
            font-size: 13px !important;
        }

        .table {
            width: 100%;
            color: #000;
            background-color: transparent;
            border-collapse: collapse;
            border: 0px;
        }

        .table th,
        .table td {
            padding: 1px 0px 4px;
            vertical-align: center;
        }


        .table-sm th,
        .table-sm td {
            padding: 0.1rem;
        }

        .table-bordered {
            border: 1px solid #000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody+tbody {
            border: 0;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        .list-inline {
            padding-left: 0;
            list-style: none;
            margin-left: 15px;
            margin-top: 25px;

        }

        .list-inline>li {
            display: inline-block;
            padding-right: 15px;
            padding-left: 15px;
        }

        .center {
            text-align: center;
        }

        td.right {
            text-align: right;
            padding-right: 25px;
        }

        .left {
            text-align: left;
        }

        tr.spaceUnder>td {
            padding-bottom: 3em;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <table class="table">
        <tbody>
            <colgroup>
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <tr>
                <td width="15%" class="left" style="vertical-align: middle;">
                    <img src="{{ public_path('storage/' . stripslashes($pas_foto)) }}" style="height: 100px">
                </td>
                <td width="85%" style="vertical-align: middle;">
                    <h2 style="margin: 0px 0px 0px !important; color: #6B728E;">RESUME KANDIDAT</h2>
                    <h1 style="margin: 0px 0px 0px !important; font-size: 36px;">{{ strtoupper($nama) }}</h1>
                    <h2 style="margin: 0px 0px 0px !important; color: #6B728E;">{{ strtoupper($category) }}</h2>
                </td>
            </tr>
        </tbody>
    </table>
    <hr style="color: #6B728E; margin: 20px 0 20px !important;">
    <table class="table">
        <tbody>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Nama Lengkap</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ ucwords($nama) }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Tempat Tanggal Lahir</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">
                    {{ $tempat_lahir . ', ' . $tgl_lahir }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Jenis Kelamin</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $gender }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Tinggi & Berat Badan</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">
                    {{ $tinggi . ' cm, ' . $berat . ' kg' }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Tinggi & Berat Badan</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">
                    {{ $tinggi . ' cm, ' . $berat . ' kg' }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Email</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $email }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">No. HP</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $telp }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Alamat Surat</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $alamat_surat }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Alamat Saat Ini</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $alamat }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Status Perkawinan</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $kawin }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Pendidikan Terakhir</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $pendidikan }}</td>
            </tr>
            <tr>
                <th width="30%" class="left" style="vertical-align: middle;">Status Pekerjaan</th>
                <td width="5%" class="left" style="vertical-align: middle;">
                    <h5>:</h5>
                </td>
                <td width="65%" class="left" style="vertical-align: middle;">{{ $pekerjaan }}</td>
            </tr>
        </tbody>
    </table>
    <hr style="color: #6B728E; margin: 20px 0 20px !important;">
    <table class="table">
        <tbody>

            <tr>
                <th width="100%" class="left" style="vertical-align: middle;">Foto Copy KTP</th>
            </tr>
            <tr>
                <td width="50%" class="left" style="vertical-align: middle;">
                    <img src="{{ public_path('storage/' . stripslashes($ktp)) }}" style="height: 200px">
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
