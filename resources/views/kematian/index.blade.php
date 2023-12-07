@extends('layouts.app')

@section('title', 'Data Kematian')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Kematian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('data_kematian.store') }}`)" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No</th>
                        <th>NIK</th>
                        <th>Nama Penduduk</th>
                        <th>Tanggal Kematian</th>
                        <th>Penyebab Kematian</th>
                        <th>Tempat Pemakaman</th>
                        <th width="13%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

@includeIf('kematian.form')
@endsection

@includeIf('includes.dataTable')
@includeIf('includes.datepicker')
@includeIf('includes.select2')

@push('scripts')
<script>
    let modal = '#modal-form';
    let table;

    table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        responsive: true,
        ajax: {
            url: '{{ route('data_kematian.data')}}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false},
            {data: 'nik', sortable: false},
            {data: 'nama_lengkap', sortable: false},
            {data: 'tanggal_kematian', searchable: false, sortable: false},
            {data: 'penyebab_kematian', searchable: false, sortable: false},
            {data: 'tempat_pemakaman', searchable: false, sortable: false},
            {data: 'action', searchable: false, sortable: false}
        ]
    });

    function addForm(url, title = 'Tambah Data Kematian') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);

        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit Data Kematian') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);

                $('#penduduk_id')
                    .trigger('change');
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }
</script>
@endpush
