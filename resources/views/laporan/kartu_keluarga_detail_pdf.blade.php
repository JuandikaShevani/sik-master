<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kartu Keluarga</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css')}}">
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
            font-weight: bold;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .custom-table,
        .custom-table th,
        .custom-table td {
            border: 1px solid #000;
        }

        .custom-table th,
        .custom-table td {
            padding: 8px;
            text-align: center;
        }

        .custom-table th {
            background-color: #eee7e7;
            font-size: 12px;
        }

        .custom-table td{
          font-size: 10px;
        }
    </style>
</head>

<body>
    <img src="{{ Storage::disk('public')->url($setting->path_image ?? '') }}" alt="Logo" class="logo">
    <h4 class="text-center">{{ $setting->nama_aplikasi}}</h4>
    <p class="text-center">{{ $setting->alamat}} {{ $setting->kelurahan}}
        {{ $setting->kecamatan}} {{ $setting->kabupaten}} {{ $setting->provinsi}} {{ $setting->kode_pos}}</p>
    <hr class="line-title">
    <div class="header">
        <p style="font-size: 30px">KARTU KELUARGA</p>
        <p style="font-size: 25px">No .{{ $query->no_kk }}</p>
    </div>
    <br>
    <div class="flex-container">
        <table style="width: auto; float: left;">
            <tbody>
                <tr>
                    <td>Nama Kepala keluarga</td>
                    <td>:</td>
                    <td>{{ $query->nama_kepala_keluarga}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $query->alamat}}</td>
                </tr>
                <tr>
                    <td>RT/RW</td>
                    <td>:</td>
                    <td>00{{ $query->rt}}/0{{ $query->rw}}</td>
                </tr>
                <tr>
                    <td>Kode Pos</td>
                    <td>:</td>
                    <td>{{ $query->kode_pos}}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: auto; float: right; margin-right: 20px;">
            <tbody>
                <tr>
                    <td>Desa/Kelurahan</td>
                    <td>:</td>
                    <td>{{ $query->kelurahan}}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td>{{ $query->kecamatan}}</td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>:</td>
                    <td>{{ $query->kabupaten}}</td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td>{{ $query->provinsi}}</td>
                </tr>
            </tbody>
        </table>
        <div style="clear: both;"></div>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Jenis Pekerjaan</th>
                <th>Golongan Darah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penduduk as $key => $item)
            <tr>
                <td width="5%">{{ ++$key }}.</td>
                <td>{{ $item->nama_lengkap ?? '-'}}</td>
                <td>{{ $item->nik ?? '-'}}</td>
                <td>{{ $item->jenis_kelamin ?? '-'}}</td>
                <td>{{ $item->tempat_lahir ?? '-'}}</td>
                <td>{{ $item->tanggal_lahir ?tanggal_indonesia($item->tanggal_lahir) : '-'}}</td>
                <td>{{ $item->agama ?? '-'}}</td>
                <td>{{ $item->pendidikan ?? '-'}}</td>
                <td>{{ $item->jenis_pekerjaan ?? '-'}}</td>
                <td>{{ $item->golongan_darah ?? '-'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="custom-table">
      <thead>
          <tr>
              <th width="5%">No.</th>
              <th>Status Perkawinan</th>
              <th>Tanggal Perkawinan</th>
              <th>Status Hubungan Dalam Keluarga</th>
              <th>Kewarganegraan</th>
              <th>No. Paspor</th>
              <th>No. KITAP</th>
              <th>Nama Ayah</th>
              <th>Nama Ibu</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($penduduk as $key => $item)
          <tr>
              <td width="5%">{{ ++$key }}.</td>
              <td>{{ $item->status_perkawinan ?? '-'}}</td>
              <td>{{ $item->tanggal_perkawinan ? tanggal_indonesia($item->tanggal_perkawinan) : '-' }}</td>
              <td>{{ $item->status_keluarga ?? '-'}}</td>
              <td>{{ $item->kewarganegaraan ?? '-'}}</td>
              <td>{{ $item->no_paspor ?? '-'}}</td>
              <td>{{ $item->no_kitap ?? '-'}}</td>
              <td>{{ $item->nama_ayah ?? '-'}}</td>
              <td>{{ $item->nama_ibu ?? '-'}}</td>
          </tr>
          @endforeach
      </tbody>
  </table>

  <div class="flex-container">
    <table style="width: auto; margin-top: 20px;">
        <tbody>
            <tr>
                <td>Dikeluarkan Tanggal</td>
                <td>:</td>
                <td>{{ tanggal_indonesia($query->tanggal_buat)}}</td>
            </tr>
        </tbody>
    </table>
</div>
</body>

</html>
