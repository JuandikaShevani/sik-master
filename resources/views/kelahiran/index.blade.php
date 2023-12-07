@extends('layouts.app')

@section('title', 'Data Kelahiran')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Kelahiran</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('data_kelahiran.store') }}`)" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No</th>
                        <th>No. Kartu Keluarga</th>
                        <th>Nama Bayi</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th width="13%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

@includeIf('kelahiran.form')
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
            url: '{{ route('data_kelahiran.data')}}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false},
            {data: 'kartu_keluarga_id', sortable: false},
            {data: 'nama', sortable: false},
            {data: 'tempat_lahir', searchable: false, sortable: false},
            {data: 'tanggal_lahir', searchable: false, sortable: false},
            {data: 'jenis_kelamin', searchable: false, sortable: false},
            {data: 'action', searchable: false, sortable: false}
        ]
    });

    function addForm(url, title = 'Tambah Data Kelahiran') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);

        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit Data Kelahiran') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);

                $('#kartu_keluarga_id')
                    .trigger('change');
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }
</script>
@endpush
