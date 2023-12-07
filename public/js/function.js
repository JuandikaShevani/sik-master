$('.custom-file-input').on('change', function () {
    let filename = $(this).val().split('\\').pop();
    $(this)
        .next('.custom-file-label')
        .addClass('selected')
        .html(filename);
})

$('[data-toggle="tooltip"]').tooltip()

$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function preview(target, image) {
    $(target)
        .attr('src', window.URL.createObjectURL(image))
        .show();
}

$('[data-dismiss=modal]').on('click', function () {
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
                showAlert(response.message, 'success');
                table.ajax.reload();
            })
            .fail(errors => {
                showAlert('Tidak dapat menghapus data');
                return;
            })
        }
    })
}

$(document).on('click', '.data-check', function() {
    $(this).toggleClass('selected');
    updateCheckAllState();
});

$('#check-all').on('change', function() {
    $('.data-check').prop('checked', $(this).prop('checked')).toggleClass('selected', $(this).prop('checked'));
});

function updateCheckAllState() {
    var allChecked = $('.data-check:checked').length === $('.data-check').length;
    $('#check-all').prop('checked', allChecked);
}

$('#delete-multiple').on('click', function () {
    var selectedIds = [];

    $('.data-check.selected').each(function () {
        selectedIds.push($(this).data('id'));
    });

    if (selectedIds.length > 0) {
        deleteMultipleItems(selectedIds);
    } else {
        showAlert('Pilih setidaknya satu data untuk dihapus.', 'warning');
    }
});

function resetForm(selector) {
    $(selector)[0].reset();

    if ($(selector).find('.summernote').length != 0) {
        $(selector).find('.summernote').summernote('code', '');
    }

    if ($(selector).find('.img-thumbnail').length != 0) {
        $(selector).find('.img-thumbnail').attr('src', "");
    }

    $('.select2').trigger('change');
    $('.form-control, .custom-select, [type=radio], [type=checkbox], [type=file], .select2, .note-editor').removeClass('is-invalid');

    $('.invalid-feedback').remove();
}

function loopForm(originalForm) {
    for (field in originalForm) {
        if ($(`[name=${field}]`).attr('type') != 'file') {
            if ($(`[name=${field}]`).hasClass('summernote')) {
                $(`[name=${field}]`).summernote('code', originalForm[field]);
            } else if ($(`[name=${field}]`).attr('type') == 'radio') {
                $(`[name=${field}]`).filter(`[value="${originalForm[field]}"]`).prop('checked', true);
            } else {
                $(`[name=${field}]`).val(originalForm[field]);
            }
            $('.select').trigger('change');
        } else {
            $(`.preview-${field}`)
            .attr('src', originalForm[field])
            .show();
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
        } else if ($(`[name=${error}]`).hasClass('summernote')) {
            $('.note-editor').addClass('is-invalid');
            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                .insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).hasClass('custom-control-input')) {
            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                .insertAfter($(`[name=${error}]`).next());
        } else if ($(`[name=${error}]`).hasClass('datetimepicker-input')) {
            $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                .insertAfter($(`[name=${error}]`).next());
        } else {
            if ($(`[name=${error}]`).length == 0) {
                $(`[name="${error}[]"]`).addClass('is-invalid');
                $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                    .insertAfter($(`[name="${error}[]"]`).next());
            } else {
                if ($(`[name=${error}]`).next().hasClass('input-group-append') || $(`[name=${error}]`).next().hasClass('input-group-prepend')) {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`).next());
                    $('.input-group-append .input-group-text').css('border-radius', '0 .25rem .25rem 0');
                    $('.input-group-prepend').next().css('border-radius', '0 .25rem .25rem 0');
                } else {
                    $(`<span class="error invalid-feedback">${errors[error][0]}</span>`)
                        .insertAfter($(`[name=${error}]`));
                }
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
        case 'warning':
            title = 'Tidak dapat menghapus data!';
            icon = 'warning';
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
