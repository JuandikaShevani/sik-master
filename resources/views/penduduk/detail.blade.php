@extends('layouts.app')

@section('title', 'Detail Data Penduduk')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"><a href="{{ route('penduduk.index')}}">Data Penduduk</a></li>
<li class="breadcrumb-item active">Detail Data Penduduk</li>
@endsection

@push('css')
<style>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid transparent;
        border-radius: .25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
    }
</style>
@endpush

@section('content')

<div class="row gutters-sm">
    <div class="col-md-4 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            @if ((!is_null($penduduk->path_image) && Storage::disk('public')->exists($penduduk->path_image)))
                <img src="{{ Storage::disk('public')->url($penduduk->path_image) }}" alt="Admin" class="rounded-circle p-1 bg-success" width="150">
            @else
                <img src="{{ asset($penduduk->path_image) }}" alt="Admin" class="rounded-circle p-1 bg-success" width="150">
            @endif

            <div class="mt-3">
              <h4>{{ $penduduk->nama_lengkap }}</h4>
              <p class="text-secondary mb-1">{{ $penduduk->nik }}</p>
              <p class="text-muted font-size-sm">{{ $penduduk->tempat_lahir }}, {{ tanggal_indonesia($penduduk->tanggal_lahir) }} ({{ $penduduk->usia }} Tahun)</p>
              <p class="btn btn-success btn-block"><b>{{ $penduduk->agama }}</b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-3">
        <ul class="list-group list-group-flush">
          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            @if($penduduk->jenis_kelamin == 'laki-laki')
                <h6 class="mb-0"><i class="fas fa-mars"></i> Jenis Kelamin</h6>
                <span class="text-secondary">{{ $penduduk->jenis_kelamin }}</span>
            @else
            <h6 class="mb-0"><i class="fas fa-venus"></i> Jenis Kelamin</h6>
            <span class="text-secondary">{{ $penduduk->jenis_kelamin }}</span>
            @endif
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0"><i class="fas fa-book"></i>   Pendidikan</h6>
            <span class="text-secondary">{{ $penduduk->pendidikan }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0"><i class="fas fa-pencil"></i>   Perkerjaan</h6>
            <span class="text-secondary">{{ $penduduk->jenis_pekerjaan }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0"><i class="fas fa-tint"></i>   Golongan Darah</h6>
            <span class="text-secondary">{{ $penduduk->golongan_darah }}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-success card-outline mb-3">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Status Perkawinan</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ $penduduk->status_perkawinan }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">Tanggal Perkawinan</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $penduduk->tanggal_perkawinan ? tanggal_indonesia($penduduk->tanggal_perkawinan) : '-'}}
              </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Status Keluarga</h6>
            </div>
            <div class="col-sm-9 text-secondary">
             {{ $penduduk->status_keluarga }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Kewarganegaraan</h6>
            </div>
            <div class="col-sm-9 text-secondary">
             {{ $penduduk->kewarganegaraan }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">No. Paspor</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ $penduduk->no_paspor ?? '-' }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">No. KITAP</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $penduduk->no_kitap ?? '-' }}
              </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">No. Handphone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ $penduduk->no_hp ?? '-' }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Nama Ayah</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              {{ $penduduk->nama_ayah }}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
                <h6 class="mb-0">Nama Ibu</h6>
              </div>
              <div class="col-sm-3 text-secondary">
                {{ $penduduk->nama_ibu }}
              </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <a class="btn btn-info"  href="{{ route('penduduk.index')}}">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
