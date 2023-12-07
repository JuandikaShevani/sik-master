@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlahKK }}</h3>

                    <p>Jumlah Kartu Keluarga</p>
                </div>
                <div class="icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <a href="{{ route('kartu_keluarga.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $jumlahPenduduk }}</h3>
                    <p>Jumlah Penduduk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('penduduk.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jumlahUser }}</h3>

                    <p>Jumlah Pengguna</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('pengguna.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray">
                <div class="inner">
                    <h3>{{ $jumlahKemiskinan }}</h3>

                    <p>Jumlah Tidak Mampu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <a href="{{ route('data_sktm.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlahKelahiran }}</h3>

                    <p>Jumlah Kelahiran</p>
                </div>
                <div class="icon">
                    <i class="fas fa-smile"></i>
                </div>
                <a href="{{ route('data_kelahiran.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlahKematian }}</h3>

                    <p>Jumlah Kematian</p>
                </div>
                <div class="icon">
                    <i class="fas fa-frown"></i>
                </div>
                <a href="{{ route('data_kematian.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{ $jumlahPendatang }}</h3>

                    <p>Jumlah Pendatang</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{ route('data_pendatang.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
                <div class="inner">
                    <h3>{{ $jumlahPindah }}</h3>

                    <p>Jumlah Pindah</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-minus"></i>
                </div>
                <a href="{{ route('data_pindah.index') }}" class="small-box-footer">Selengkapnya <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Penduduk Domisili Berdasarkan Kriteria</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Balita </span>
                    <span class="info-box-number">{{ $jumlahBalita }} Orang</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Kanak-kanak </span>
                    <span class="info-box-number">{{ $jumlahKanak }} Orang</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Remaja </span>
                    <span class="info-box-number">{{ $jumlahRemaja }} Orang</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Dewasa</span>
                    <span class="info-box-number">{{ $jumlahDewasa }} Orang</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box mb-3 bg-secondary">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Penduduk Lansia</span>
                    <span class="info-box-number">{{ $jumlahLansia }} Orang</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var areaChartData = {
                labels: @json($listNama),
                datasets: [{
                        label: 'Laki-laki',
                        backgroundColor: 'rgb(0, 150, 255)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: @json($listJumlahPria)
                    },
                    {
                        label: 'Perempuan',
                        backgroundColor: 'rgb(255, 82, 82)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: @json($listJumlahPerempuan)
                    },
                ]
            }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        });
    </script>
@endpush
