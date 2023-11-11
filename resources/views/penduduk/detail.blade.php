@extends('layouts.app')

@section('title', 'Detail Data Penduduk')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('penduduk.index')}}">Detail Data Penduduk</a></li>
<li class="breadcrumb-item active">Detail Data Penduduk</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-globe"></i> &nbsp; Foto Profil Penduduk
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="post">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <img class="img-fluid" src="{{ Storage::disk('public')->url($penduduk->path_image) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <x-card>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->nama_lengkap }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nik">NIK :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->nik }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->jenis_kelamin }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="usia">Usia :</label>
                        <input type="text" class="form-control"
                            value="{{ $penduduk->usia ? $penduduk->usia . ' tahun' : ''}}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="agama">Agama :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->agama }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->tempat_lahir }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir :</label>
                        <input type="text" class="form-control"
                            value="{{ tanggal_indonesia($penduduk->tanggal_lahir) }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->pendidikan }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="jenis_pekerjaan">Jenis Pekerjaan :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->jenis_pekerjaan }}" readonly>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="golongan_darah">Golongan Darah :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->golongan_darah }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="status_perkawinan">Status Perkawinan :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->status_perkawinan }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_perkawinan">Tanggal Perkawinan :</label>
                        <input type="text" class="form-control"
                            value="{{ $penduduk->tanggal_perkawinan ? tanggal_indonesia($penduduk->tanggal_perkawinan) : '-'}}"
                            readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="status_keluarga">Status Keluarga :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->status_keluarga }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->kewarganegaraan }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_paspor">No. Paspor :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->no_paspor ?? '-' }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_kitap">No. KITAP :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->no_kitap ?? '-' }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_ayah">Nama Ayah :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->nama_ayah }}" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nama_ibu">Nama Ibu :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->nama_ibu }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="no_hp">No. HP :</label>
                        <input type="text" class="form-control" value="{{ $penduduk->no_hp ?? '-' }}" readonly>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>
@endsection
