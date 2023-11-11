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

    $('[data-dismiss=modal]').on('click', function (e) {
        $(`${modal} [name=_method]`).val('post');
    });

    function submitForm(originalForm) {
        $.post({
                url: $(originalForm).attr('action'),
                data: new FormData(originalForm),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false
        })
        .done(response => {
                $(modal).modal('hide');
                $(`${modal} [name=_method]`).val('post');
                showAlert(response.message, 'success');
                table.ajax.reload();
        })
        .fail(errors => {
                if (errors.status == 422) {
                    loopErrors(errors.responseJSON.errors);
                    return;
                }
                showAlert(errors.responseJSON.message, 'error');
        });
    }

    function deleteData(url) {
        Swal.fire({
            title: 'Konfirmasi Hapus Data!',
            text: 'Anda yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(url, {
                    '_method': 'delete'
                })
                .done(response => {
                    showAlert(response.message, 'error');
                    table.ajax.reload();
                })
                .fail(errors => {
                    showAlert('Tidak dapat menghapus data');
                    return;
                })
            }
        })
    }

    function resetForm(selector) {
        $(selector)[0].reset();

        $('.select2').trigger('change');
        $('.form-control, .custom-select, [type=file], .select2').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    }

    function loopForm(originalForm) {
        for (field in originalForm) {
            if ($(`[name=${field}]`).attr('type') != 'file') {
                $(`[name=${field}]`).val(originalForm[field]);
                $('.select').trigger('change');
            }
        }
    }

    function loopErrors(errors) {
        $('.invalid-feedback').remove();

        if (errors == undefined) {
            return;
        }

        for (error in errors) {
            $(`[name=${error}]`).addClass('is-invalid');
            if ($(`[name=${error}]`).hasClass('select2')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                .insertAfter($(`[name=${error}]`).next());
            } else if  ($(`[name=${error}]`).hasClass('custom-control-input')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } else if  ($(`[name=${error}]`).hasClass('datetimepicker-input')) {
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name=${error}]`).next());
            } else {
                if ($(`[name=${error}]`).length == 0) {
                    $(`[name="${error}[]"]`).addClass('is-invalid');
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name="${error}[]"]`).next());
                } else {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`));
                }
            }
        }
    }

    function showAlert(message, type) {
        let title = '';
        let icon = '';
        switch (type) {
            case 'success':
                title = 'Success';
                icon = 'success';
                break;
            case 'error':
                title = 'Deleted';
                icon = 'error';
                break;
            default:
                break;
        }

        Swal.fire({
            icon: icon,
            title: title,
            text:  message,
            showConfirmButton: false,
            timer: 1500
        });
    }
</script>
@endpush
