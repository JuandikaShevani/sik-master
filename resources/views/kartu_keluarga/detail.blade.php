@extends('layouts.app')

@section('title', 'Detail Data Kartu Keluarga')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('kartu_keluarga.index')}}">Data Kartu Keluarga</a></li>
    <li class="breadcrumb-item active">Detail Data Kartu Keluarga</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="no_kk">No. Kartu Keluarga :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->no_kk }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_kepala_keluarga">Nama Kepala Keluarga :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->nama_kepala_keluarga }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <textarea class="form-control" rows="3" disabled>{{ $kartu_keluarga->alamat }}</textarea>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="rt">RT :</label>
                            <input type="text" class="form-control" value="{{ '0' . $kartu_keluarga->rt }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="rw">RW :</label>
                            <input type="text" class="form-control" value="{{ '0' . $kartu_keluarga->rw }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->kode_pos }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tanggal_buat">Dikeluarkan Tanggal :</label>
                            <input type="text" class="form-control" value="{{ tanggal_indonesia($kartu_keluarga->tanggal_buat) }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kelurahan">Desa/Kelurahan :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->kelurahan }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->kecamatan }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->kabupaten }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi :</label>
                            <input type="text" class="form-control" value="{{ $kartu_keluarga->provinsi }}" disabled>
                        </div>
                    </div>
                </div>
            </x-card>

            <div class="card">
                <div class="card-body">
                    <x-table id="detail-keluarga">
                        <x-slot name="thead">
                            <th width="5%">No</th>
                            <th>NIK</th>
                            <th>Nama Penduduk</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Keluarga</th>
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>

@endsection

@includeIf('includes.dataTable')

@push('scripts')
<script>
   let table;

   table = $('#detail-keluarga').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: '{{ route('kartu_keluarga.penduduk', $kartu_keluarga->id) }}',
            columns: [
                {data: 'DT_RowIndex', searchable: false},
                {data: 'nik', name: 'nik', sortable: false},
                {data: 'nama_lengkap', name: 'nama_lengkap', sortable: false },
                {data: 'jenis_kelamin', name: 'jenis_kelamin', searchable: false, sortable: false },
                {data: 'status_keluarga', name: 'status_keluarga', searchable: false, sortable: false},
            ]
        });
</script>
@endpush
