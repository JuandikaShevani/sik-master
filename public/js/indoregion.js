$.get('/get-districts', function (data) {
    $.each(data, function (key, value) {
        $('#kecamatan').append('<option value="' + value.id + '">' + value.name + '</option>');
    });
});

$.get('/get-regencies', function (regencyData) {
    $.each(regencyData, function (key, value) {
        $('#kabupaten').append('<option value="' + value.id + '">' + value.name + '</option>');
    });
});

$.get('/get-provinces', function (provinceData) {
    $.each(provinceData, function (key, value) {
        $('#provinsi').append('<option value="' + value.id + '">' + value.name + '</option>');
    });
});

$('#kecamatan').on('change', function () {
    var districtId = $(this).val();
    if (districtId) {
        $.get('/get-regency-province', {
            district_id: districtId
        }, function (data) {
            $('#kabupaten option').prop('selected', false);
            $('#provinsi option').prop('selected', false);

            $('#kabupaten option[value="' + data.regency.id + '"]').prop('selected', true);
            $('#provinsi option[value="' + data.province.id + '"]').prop('selected', true);

            $('#kabupaten').trigger('change.select2');
            $('#provinsi').trigger('change.select2');
        });
    }
});

$('#kabupaten').on('change', function() {
    var regencyId = $(this).val();
    if (regencyId) {
        $.get('/get-province', {
            regency_id: regencyId
        }, function (data) {
            $('#provinsi option').prop('selected', false);
            $('#provinsi option[value="' + data.province.id + '"]').prop('selected', true);
            $('#provinsi').trigger('change.select2');
        });
    }
});

$('.select2').select2();
