<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('AdminLTE/dist/css/adminlte.min.css')}}">
    <style>
        body {
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #cccaca;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ffffff;
        }

        .logo {
                width: 100px;
                height: 100px;
                margin-right: 10px;
        }

        @media print {
            body {
                margin: 0;
                padding: 10px;
            }

            table {
                page-break-inside: auto;
            }

            thead {
                display: table-header-group;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 10px;
            }

            .logo img {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }

            h4 {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ Storage::disk('public')->url($setting->path_image ?? '') }}" alt="Logo" class="logo">
        <h4 class="text-center">Laporan Kartu Keluarga</h4>
    </div>
    <small class="float-right">{{ tanggal_indonesia(date('Y-m-d')) }}</small>
    <br><br>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>No. Kartu Keluarga</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Desa/Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kabupaten/Kota</th>
                <th>Kode Pos</th>
                <th>Provinsi</th>
                <th>Dikeluarkan Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ ++$key }}.</td>
                    <td>{{ $item->no_kk}}</td>
                    <td>{{ $item->nama_kepala_keluarga}}</td>
                    <td>{{ $item->alamat}}</td>
                    <td>0{{ $item->rt}} / 0{{ $item->rw}}</td>
                    <td>{{ $item->kelurahan}}</td>
                    <td>{{ $item->kecamatan}}</td>
                    <td>{{ $item->kabupaten}}</td>
                    <td>{{ $item->kode_pos}}</td>
                    <td>{{ $item->provinsi}}</td>
                    <td>{{ tanggal_indonesia($item->tanggal_buat)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
