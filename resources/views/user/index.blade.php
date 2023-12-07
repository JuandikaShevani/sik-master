@extends('layouts.app')

@section('title', 'Pengguna')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pengguna</li>
@endsection

@push('css')
    <style>
        .input-group-text {
            background-color: transparent;
            border: none;
        }

        .open-eye, .closed-eye {
            width: 20px;
            height: auto;
            cursor: pointer;
        }

        .closed-eye {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <button onclick="addForm(`{{ route('pengguna.store') }}`)" class="btn btn-success"><i
                        class="fas fa-plus-circle"></i> Tambah Data</button>
                </x-slot>
                <x-table>
                    <x-slot name="thead">
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="13%"><i class="fas fa-cog"></i></th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>

@includeIf('user.form')
@endsection

@includeIf('includes.dataTable')

@push('scripts')
<script>
    let modal = '#modal-form';
    let table;

    table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        responsive: true,
        ajax: {
            url: '{{ route('pengguna.data')}}',
        },
        columns: [
            {data: 'DT_RowIndex', searchable: false},
            {data: 'name', sortable: false},
            {data: 'email', sortable: false},
            {data: 'role', searchable: false, sortable: false},
            {data: 'action', searchable: false, sortable: false}
        ]
    });

    function addForm(url, title = 'Tambah Data Pengguna') {
        $(modal).modal('show');
        $(`${modal} .modal-title`).text(title);
        $(`${modal} form`).attr('action', url);

        resetForm(`${modal} form`);
    }

    function editForm(url, title = 'Edit Data Pengguna') {
        $.get(url)
            .done(response => {
                $(modal).modal('show');
                $(`${modal} .modal-title`).text(title);
                $(`${modal} form`).attr('action', url);
                $(`${modal} [name=_method]`).val('put');

                resetForm(`${modal} form`);
                loopForm(response.data);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })
    }

    document.addEventListener('DOMContentLoaded', function () {
        const eyeToggle = document.querySelector('.eye-toggle');
        const passwordInput = document.querySelector('#password');
        const openEyeIcon = document.querySelector('.open-eye');
        const closedEyeIcon = document.querySelector('.closed-eye');

        eyeToggle.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            openEyeIcon.style.display = type === 'password' ? 'inline' : 'none';
            closedEyeIcon.style.display = type === 'password' ? 'none' : 'inline';
        });
    });

</script>
@endpush
