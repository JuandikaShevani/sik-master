@extends('layouts.app')

@section('title', 'Pengujian Algoritma Sequential Search')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pengujian Algoritma Sequential Search</li>
@endsection

@push('css')
    <style>
        #autocomplete-results {
            width: 50%;
            display: none;
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            position: absolute;
            background-color: #fff;
            z-index: 1000;
        }

        #autocomplete-results div {
            padding: 8px;
            cursor: pointer;
            border-bottom: 1px solid #ced4da;
        }

        #autocomplete-results div:last-child {
            border-bottom: none;
        }

        #autocomplete-results div:hover {
            background-color: #28a745;
        }

        .form-inline label {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: left;
            margin-bottom: 0;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <x-card>
                <x-slot name="header">
                    <form>
                        <div class="form-inline">
                            <input type="text" class="form-control" id="search-input" autocomplete="off"
                                placeholder="Cari Nama Lengkap...">
                            <button type="button" id="search-btn" class="btn btn-success ml-2"><i
                                    class="fas fa-search"></i></button>
                            <button type="button" id="resetData" class="btn btn-primary ml-2"><i class="fas fa-undo"></i>
                                Reset Data</button>
                            <div class="custom-controls ml-2">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="searchByNamaLengkap"
                                        name="searchType" value="nama_lengkap" checked>
                                    <label for="searchByNamaLengkap" class="custom-control-label">Nama Lengkap</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="searchByNIK" name="searchType"
                                        value="nik">
                                    <label for="searchByNIK" class="custom-control-label">NIK</label>
                                </div>
                            </div>
                        </div>
                        <div id="autocomplete-results"></div>
                    </form>
                </x-slot>
                <x-table id="penduduk-table">
                    <x-slot name="thead">
                        <th width="5%">No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                    </x-slot>
                </x-table>
                <div class="search-time-info"></div>
            </x-card>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <x-table id="hasil-pengujian-table">
                        <x-slot name="thead">
                            <th width="5%">No.</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Kecepatan Pencarian (milidetik)</th>
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>

@endsection

@includeIf('includes.dataTable')

@push('scripts')
    <script>
        var pendudukTable = $('#penduduk-table').DataTable({
            processing: true,
            autoWidth: false,
            responsive: true,
            searching: false,
            ordering: false,
            ajax: {
                url: '{{ route('pengujian.data') }}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    sortable: false,
                    searchable: false
                },
                {
                    data: 'nik',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'nama_lengkap',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tempat_lahir',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'tanggal_lahir',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'jenis_kelamin',
                    searchable: false,
                    sortable: false
                },
                {
                    data: 'agama',
                    searchable: false,
                    sortable: false
                },
            ]
        });

        $(document).ready(function() {
            var hasilPengujianTable = $('#hasil-pengujian-table').DataTable({
                processing: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pengujian.hasil-data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'nama_lengkap'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'search_time'
                    },
                ],
                ordering: false,
            });

            var pendudukData;
            var searchInput = $('#search-input');
            var searchTypeRadios = $('input[name="searchType"]:checked');
            var autocompleteResults = $('#autocomplete-results');

            $.ajax({
                url: '{{ route('pengujian.get-data') }}',
                method: 'GET',
                success: function(data) {
                    pendudukData = data;
                }
            });

            $('input[name="searchType"]').on('change', function() {
                var searchType = $('input[name="searchType"]:checked').val();
                if (searchType === 'nama_lengkap') {
                    searchInput.attr('placeholder', 'Cari Nama Lengkap...');
                } else if (searchType === 'nik') {
                    searchInput.attr('placeholder', 'Cari NIK...');
                }
                searchInput.val('');
                autocompleteResults.empty();
            });

            // $('#search-input').on('input', function() {
            //     var inputVal = $(this).val().trim().toLowerCase();
            //     var searchType = $('input[name="searchType"]:checked').val();

            //     if (inputVal.length > 0) {
            //         var matchedPenduduk;

            //         if (inputVal.length === 1) {
            //             matchedPenduduk = [...pendudukData].sort((a, b) => a.nama_lengkap.localeCompare(b.nama_lengkap));
            //         } else {
            //             matchedPenduduk = sequentialSearch(inputVal);
            //         }
            //         autocompleteResults.empty();

            //         if (matchedPenduduk.length > 0) {
            //             autocompleteResults.empty();
            //             matchedPenduduk.forEach(function(penduduk) {
            //             if (searchType === 'nik') {
            //                 autocompleteResults.append('<div>' + penduduk.nik + '</div>');
            //             } else if (searchType === 'nama_lengkap') {
            //                 autocompleteResults.append('<div>' + penduduk.nama_lengkap + '</div>');
            //             }
            //         });
            //             autocompleteResults.show();
            //         } else {
            //             autocompleteResults.hide();
            //         }
            //     } else {
            //         autocompleteResults.hide();
            //     }
            // });

            $('#search-input').on('input', function() {
                var inputVal = $(this).val().trim().toLowerCase();
                var searchType = $('input[name="searchType"]:checked').val();

                if (inputVal.length > 0) {
                    var matchedPenduduk = filterData(inputVal, searchType);
                    autocompleteResults.empty();

                    if (matchedPenduduk.length > 0) {
                        autocompleteResults.empty();
                        matchedPenduduk.forEach(function(penduduk) {
                            if (searchType === 'nik') {
                                autocompleteResults.append('<div>' + penduduk.nik + '</div>');
                            } else if (searchType === 'nama_lengkap') {
                                autocompleteResults.append('<div>' + penduduk.nama_lengkap +
                                    '</div>');
                            }
                        });
                        autocompleteResults.show();
                    } else {
                        autocompleteResults.hide();
                    }
                } else {
                    autocompleteResults.hide();
                }
            });

            function filterData(input, searchType) {
                return pendudukData.filter(function(penduduk) {
                    if (searchType === 'nik') {
                        return penduduk.nik.toLowerCase().includes(input);
                    } else if (searchType === 'nama_lengkap') {
                        return penduduk.nama_lengkap.toLowerCase().includes(input);
                    }
                });
            }

            $('#autocomplete-results').on('click', 'div', function() {
                var selectedNamaLengkap = $(this).text();
                searchInput.val(selectedNamaLengkap);
                autocompleteResults.hide();
                searchInput.focus();
            });

            $(document).on('click', function() {
                if (!$(event.target).closest('#autocomplete-results').length) {
                    autocompleteResults.hide();
                }
            });

            $('#search-btn').on('click', function() {
                var searchTerm = searchInput.val().toLowerCase();
                var searchType = $('input[name="searchType"]:checked').val();

                if (searchTerm.trim() !== '') {
                    var startTime = performance.now();
                    var searchResults = sequentialSearch(searchTerm, searchType);
                    var endTime = performance.now();
                    var searchTime = endTime - startTime;

                    if (!Number.isNaN(searchTime)) {
                        if (searchResults.length > 0) {
                            saveSearchResults(searchResults, 'ditemukan', searchTime, searchType);
                            hasilPengujianTable.ajax.reload();
                            showAlert('success', 'Pencarian Data Ditemukan', 'Data Dimunculkan!');
                        } else {
                            saveSearchResults([], 'tidak ditemukan', searchTime, searchType);
                            hasilPengujianTable.ajax.reload();
                            showAlert('error', 'Pencarian Tidak Ditemukan',
                                'Data Tidak Sesuai Dengan Data Penduduk!');
                        }
                    }
                } else {
                    showAlert('warning', 'Data Belum Terisi', 'Data Perlu Diisi Untuk Melakukan Pencarian!')
                }
            });

            $('#resetData').on('click', function() {
                $.ajax({
                    url: '{{ route('pengujian.reset') }}',
                    type: 'POST',
                    success: function(response) {
                        showAlert('success', 'Data Tereset!', 'Data Berhasil Direset!');
                        hasilPengujianTable.ajax.reload();
                    }
                });
            });

            function sequentialSearch(input, searchType) {
                var results = [];
                if (input.trim() === '') {
                    return pendudukData.map(function(penduduk) {
                        return {
                            'nik': penduduk.nik,
                            'nama_lengkap': penduduk.nama_lengkap
                        };
                    });
                }
                var regrex = new RegExp('^' + input + '$', 'i');
                for (var i = 0; i < pendudukData.length; i++) {
                    if ((searchType === 'nik' && pendudukData[i].nik.match(regrex)) ||
                        (searchType === 'nama_lengkap' && pendudukData[i].nama_lengkap.match(regrex))) {
                        results.push({
                            'nik': pendudukData[i].nik,
                            'nama_lengkap': pendudukData[i].nama_lengkap
                        });
                    }
                }
                return results;
            }

            function saveSearchResults(results, status, searchTime) {
                var searchType = $('input[name="searchType"]:checked').val();

                if (results.length === 0) {
                    if (searchType === 'nik') {
                        results.push({
                            'nik': searchInput.val().trim(),
                            'nama_lengkap': null
                        });
                    } else if (searchType === 'nama_lengkap') {
                        results.push({
                            'nik': null,
                            'nama_lengkap': searchInput.val().trim().toLowerCase()
                        });
                    }
                }

                $.ajax({
                    url: '{{ route('pengujian.store') }}',
                    method: 'POST',
                    data: {
                        results: results,
                        status: status,
                        searchTime: searchTime,
                        searchType: searchType,
                    }
                });
            }

            function showAlert(icon, title, text) {
                switch (icon) {
                    case 'success':
                        icon = icon;
                        title = title;
                        break;
                    case 'error':
                        icon = icon;
                        title = title;
                        break;
                    case 'warning':
                        icon = icon;
                        title = title;
                    default:
                        break;
                }

                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    </script>
@endpush
