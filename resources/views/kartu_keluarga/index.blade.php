@extends('layouts.app')

@section('title', 'Data Kartu Keluarga')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Kartu Keluarga</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('kartu_keluarga.store') }}`)" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tambah Data</button>
                    <button id="delete-multiple" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus Multiple</button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%"><input type="checkbox" id="check-all"></th>
                        <th width="5%">No.</th>
                        <th>No. Kartu Keluarga</th>
                        <th>Nama Kepala Keluarga</th>
                        <th>Dikeluarkan Tanggal</th>
                        <th>Alamat</th>
                        <th>Jumlah Anggota Keluarga</th>
                        <th width="16%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

@includeIf('kartu_keluarga.form')
@endsection

@includeIf('includes.indoregion')
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
        ordering: false,
        ajax: {
            url: '{{ route('kartu_keluarga.data')}}',
        },
        columns: [
            {data: 'checkbox', searchable: false},
            {data: 'DT_RowIndex', searchable: false},
            {data: 'no_kk'},
            {data: 'nama_kepala_keluarga'},
            {data: 'tanggal_buat', searchable: false},
            {data: 'alamat', searchable:false},
            {data: 'jumlah_anggota_kk', searchable: false},
            {data: 'action', searchable: false}
        ]
    });

    function addForm(url, title = 'Tambah Data Kartu Keluarga') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);

        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit Data Kartu Keluarga') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);

                $('#kecamatan').trigger('change');
                $('#kabupaten').trigger('change');
                $('#provinsi').trigger('change');
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }

    function deleteMultipleItems(selectedIds) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus data yang dipilih?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('kartu_keluarga.delete-multiple')}}',
                type: 'DELETE',
                data: {ids: selectedIds},
            })
            .done(function (response) {
                showAlert(response.message, 'success');
                table.ajax.reload();
            })
            .fail(function (errors) {
                showAlert('Tidak Dapat Menghapus Data', 'error');
            });
        }
        });
    }
</script>
@endpush
