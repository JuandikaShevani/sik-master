@extends('layouts.app')

@section('title', 'Laporan Data Penduduk')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan Data Penduduk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
           <p style="margin-bottom: 20px; font-size: 15px;">
            {{ tanggal_indonesia($start) .' s/d '. tanggal_indonesia($end)}}
           </p>
            <x-card>
                <x-slot name="header">
                    <button data-toggle="modal" data-target="#modal-form" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Ubah Periode</button>
                    <a href="{{ route('laporan.penduduk_pdf', compact('start', 'end'))}}" target="_blank" class="btn btn-danger"><i
                            class="fas fa-file-pdf"></i> Cetak PDF</a>
                    <a href="{{ route('laporan.penduduk_excel')}}" target="_blank" class="btn btn-success"><i
                            class="fas fa-file-excel"></i> Export Excel</a>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No.</th>
                        <th>No. Kartu Keluarga</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tempat & Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

@includeIf('laporan.form')
@endsection

@includeIf('includes.dataTable')
@includeIf('includes.datepicker')

@push('scripts')
<script>
    let table;

    table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        responsive: true,
        ordering: false,
        ajax: {
            url: '{{ route('laporan.data_penduduk', compact('start', 'end')) }}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false},
            {data: 'kartu_keluarga_id', sortable: false},
            {data: 'nik', sortable:false},
            {data: 'nama_lengkap', sortable: false},
            {data: 'ttl', searchable: false, sortable: false},
            {data: 'jenis_kelamin', searchable: false, sortable: false},
        ]
    });
</script>
@endpush
