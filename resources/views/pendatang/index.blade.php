@extends('layouts.app')

@section('title', 'Data Pendatang')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pendatang</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('data_pendatang.store') }}`)" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No.</th>
                        <th>NIK</th>
                        <th>Nama Pendatang</th>
                        <th>Nama Pelapor</th>
                        <th>Tanggal Datang</th>
                        <th>Tempat Asal</th>
                        <th width="13%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

@includeIf('pendatang.form')
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
            url: '{{ route('data_pendatang.data')}}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false},
            {data: 'nik', sortable: false},
            {data: 'nama_pendatang', sortable: false},
            {data: 'pelapor_id', sortable: false},
            {data: 'tanggal_datang', searchable: false, sortable: false},
            {data: 'asal', searchable: false, sortable: false},
            {data: 'action', searchable: false, sortable: false}
        ]
    });

    function addForm(url, title = 'Tambah Data Pendatang') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);

        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit Data Pendatang') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);

                $('#pelapor_id')
                    .trigger('change');
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }
</script>
@endpush
