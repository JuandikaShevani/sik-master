<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penduduk</title>
    <link rel="stylesheet" href="{{ public_path('AdminLTE/dist/css/adminlte.min.css')}}">
    <style>
        .logo {
            position: absolute;
            width: 80px;
            height: auto;
        }

        .line-title {
            margin-top: 30px;
            border: 0;
            border-style: inset;
            border-top: 3px solid #000;
        }

        .h4 {
            line-height: 1.6;
            font-family: 'Times New Roman', Times, serif;
            margin-bottom: 10px;
        }

        .header {
            margin-top: 30px;
            line-height: 0.7;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000000;
            font-size: 12px;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #eee7e7;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        h4 {
            margin: 0;
        }

        /* @media print {
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
        } */
    </style>
</head>
<body>
    <img src="{{ Storage::disk('public')->url($setting->path_image ?? '') }}" alt="Logo" class="logo">
    <h4 class="text-center">{{ $setting->nama_aplikasi}}</h4>
    <p class="text-center" style="margin-top: 7px;">{{ $setting->alamat}} {{ $setting->kelurahan}}
        {{ $setting->kecamatan}} {{ $setting->kabupaten}} {{ $setting->provinsi}} {{ $setting->kode_pos}}</p>
    <hr class="line-title">
    <div class="header">
        <p style="font-size: 30px; font-weight: bold;">Laporan Penduduk</p>
        <p style="font-size: 20px;">Tanggal {{ tanggal_indonesia($start) }} s/d Tanggal {{ tanggal_indonesia($end) }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>No. Kartu Keluarga</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Tempat & Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Jenis Pekerjaan</th>
                <th>Golongan Darah</th>
                <th>Status & Tanggal Perkawinan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($query as $key => $item)
                <tr>
                    <td>{{ ++$key }}.</td>
                    <td>{{ $item->kartu_keluarga->no_kk}} - {{ $item->kartu_keluarga->nama_kepala_keluarga}}</td>
                    <td>{{ $item->nik}}</td>
                    <td>{{ $item->nama_lengkap}}</td>
                    <td>{{ $item->tempat_lahir}}, {{ tanggal_indonesia($item->tanggal_lahir)}} ({{ $item->usia}} Tahun)</td>
                    <td>{{ $item->jenis_kelamin}}</td>
                    <td>{{ $item->agama}}</td>
                    <td>{{ $item->pendidikan}}</td>
                    <td>{{ $item->jenis_pekerjaan}}</td>
                    <td>{{ $item->golongan_darah}}</td>
                    <td>{{ $item->status_perkawinan}} ({{ $item->tanggal_perkawinan ? tanggal_indonesia($item->tanggal_perkawinan) : '-'}})</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
