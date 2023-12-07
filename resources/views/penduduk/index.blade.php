@extends('layouts.app')

@section('title', 'Penduduk')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Penduduk</li>
@endsection

@push('css')
    <style>
        .dataTables_wrapper .dataTable thead .sorting,
        .dataTables_wrapper .dataTable thead .sorting_asc,
        .dataTables_wrapper .dataTable thead .sorting_desc {
            background: none;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('penduduk.store') }}`)" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Tambah Data
                    </button>
                    <button id="delete-multiple" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Hapus Multiple
                    </button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%"><input type="checkbox" id="check-all"></th>
                        <th width="5%">No.</th>
                        <th>No. Kartu Keluarga</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tempat & Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th width="15%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

    @includeIf('penduduk.form')
@endsection

@includeIf('includes.select2')
@includeIf('includes.dataTable')
@includeIf('includes.datepicker')

@push('scripts')
    <script>
        let modal = '#modal-form';
        let table;

        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('penduduk.data') }}',
            },
            columns: [{
                    data: 'checkbox',
                    sortable: false,
                    searchable: false
                },
                {
                    data: 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'kartu_keluarga_id',
                    sortable: false
                },
                {
                    data: 'nik',
                    sortable: false
                },
                {
                    data: 'nama_lengkap',
                    sortable: false
                },
                {
                    data: 'ttl',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'jenis_kelamin',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'action',
                    searchable: false,
                    sortable: false
                }
            ],
            ordering: false
        });


        function addForm(url, title = 'Tambah Data Penduduk') {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);

            resetForm(`${modal} form`);
        }

        function editForm(url, title = 'Edit Data Penduduk') {
            $.get(url)
                .done(response => {
                    $(modal).modal('show');
                    $(`${modal} .modal-title`).text(title);
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('put');

                    resetForm(`${modal} form`);
                    loopForm(response.data);

                    $('#kartu_keluarga_id').trigger('change');

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
                            url: '{{ route('penduduk.delete-multiple') }}',
                            type: 'DELETE',
                            data: {
                                ids: selectedIds
                            },
                        })
                        .done(function(response) {
                            showAlert(response.message, 'success');
                            table.ajax.reload();
                        })
                        .fail(function(errors) {
                            showAlert('Tidak Dapat Menghapus Data', 'error');
                        });
                }
            });
        }
    </script>
@endpush
